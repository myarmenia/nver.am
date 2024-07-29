<?php
namespace App\Services\Interface;

use App\Mail\SendUserProductId;
use App\Models\Product;
use App\Models\TmpProduct;
use Illuminate\Support\Facades\Mail;
use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\DB;
use App\Services\FileUploadService;
use App\Models\Image;


class InterfaceService
{
    public function addProducts($data)
    {
        try {
            DB::beginTransaction();
            if ($data['type'] == 'add-yourself') {
                $jsonData = [
                    "owner" => $data['owner'],
                    "title" => $data['title'],
                    "cashback" => $data['cashback'],
                    "title_am" => GoogleTranslate::trans($data['title'], 'hy', 'ru'),
                    "price_in_store" => $data['price_in_store'],
                ];

                $readyData = [
                    'text' => '',
                    'type' => Product::TYPE_CUSTOM,
                    'owner_email' => $data['owner_email'],
                    'payment_id' => getUniquePaymentId(),
                    'product_details' => json_encode($jsonData),
                    'category_id' => $data['category_id'],
                ];

                $product = Product::create($readyData);
                $photos = $data['photos'];

                foreach ($photos as $key => $photo) {

                    $photoPath = FileUploadService::uploadCustom($photo, "telegram/$product->id");

                    Image::create(['product_id' => $product->id, 'path' => $photoPath]);

                }
                Mail::send(new SendUserProductId($product->payment_id, $data['owner_email']));
                DB::commit();
                return ['success' => true, 'payment_id' => $product->payment_id];

            } elseif ($data['type'] == 'add-from-suppot') {
                $data['payment_id'] = getUniquePaymentId();
                $tmpProduct = TmpProduct::create($data);

               if($tmpProduct) {
                   Mail::send(new SendUserProductId($tmpProduct->payment_id, $data['owner_email']));
                   DB::commit();
                  return ['success' => true, 'payment_id' => $tmpProduct->payment_id];
               }else {
                 return ['success' => false];
               }
            }
            
            DB::rollBack();
            return ['success' => false];
        } catch (\Exception $e) {
            info("Exception", [$e->getMessage()]);
            DB::rollBack();
            dd($e->getMessage());
        } catch (\Error $e) {
            info("error", [$e->getMessage()]);
            DB::rollBack();
            dd($e->getMessage());
        }
    }

}