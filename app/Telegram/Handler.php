<?php

namespace App\Telegram;

use App\Models\Image;
use App\Models\Product;
use App\Services\FileUploadService;
use DefStudio\Telegraph\Enums\ChatActions;
use DefStudio\Telegraph\Facades\Telegraph;
use DefStudio\Telegraph\Handlers\WebhookHandler;
use DefStudio\Telegraph\Keyboard\Button;
use DefStudio\Telegraph\Keyboard\Keyboard;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Stringable;
use Illuminate\Support\Facades\DB;
use DefStudio\Telegraph\Handlers\TelegraphBotHandler;
use DefStudio\Telegraph\Models\TelegraphBot;
use Illuminate\Support\Facades\Session;




class Handler extends WebhookHandler
{
    public function hello()
    {
        $this->reply("Hello, it's your first bot message!");
    }

    public function start()
    {
        // Session::flush();

        $this->reply("Итак, давайте начнем процесс добавления продукта Начните с написания названия продукта.");
      
    }

    protected function handleProductName(TelegraphBot $bot, Telegraph $telegraph, $name)
    {
       info($name);
    }

    //add webhook php artisan telegraph:set-webhook 

    protected function handleUnknownCommand(Stringable $text): void
    {
        if ($text->value() == "/start") {
            $this->reply('Happy to see you');
        } else {
            $this->reply('Wrong command');
        }
    }

    protected function handleChatMessage(Stringable $text): void
    {

        // /avelacnel key ery sessioni mej amen 
        if(!Session::get('product')){
            info(1, [!Session::get('product')]);
            $data = [
                'title' => $text->value(),
                'owner' => '',
                'cashback' => '',
                'title_am' => '',
                'price_in_store' => '',
            ];
            
            Session::put('product', $data);
            $this->reply("Спасибо за добавление названия продукта, теперь добавьте имя владельца продукта в телеграмме` cashback_add_product");

            // {
            //     "owner": "kavunova_a",
            //     "title": "Сумка мужская через плечо",
            //     "cashback": "50",
            //     "title_am": true,
            //     "price_in_store": "377"
            // }
            // Session::put('product', $text->value());
        }else {
            info(2);

            $product = Session::get('product');
            if($product['owner'] == ''){
                $product['owner'] = $text->value();
                Session::put('product', $product);
                $this->reply("Спасибо за добавление названия владельца, теперь добавьте кешбек продукта в следующем формате '50'");
            } else if($product['cashback'] == ''){
                $product['cashback'] = $text->value();
                Session::put('product', $product);
                $this->reply("Спасибо за добавление кешбека, теперь добавьте цену товара, которая будет рассчитана в рублях в следующем формате '500'");
            }
            else if($product['price_in_store'] == ''){
                $product['price_in_store'] = $text->value();
                Session::put('product', $product);
                $this->reply("Спасибо за добавление названия владельца, теперь добавьте кешбек продукта в следующем формате '50'");
            }
            // $this->reply("Теперь добавьте имя владельца продукта в телеграмме в следующем формате 'cashback_add_product'");
        }

        info('product', [Session::get('product')]);
//         try {
//             DB::beginTransaction();
//             $token = env('TELEGRAM_BOT_TOKEN');
//             $allData = $this->message->toArray();
//             $product = Product::create(['text' => json_encode($allData['text'], JSON_UNESCAPED_UNICODE)]);
//             // info("product", [$product]);
//             $response = Telegraph::getFileInfo($allData['photos'][2]['id'])->send();
//             $filePath = $response->json()['result']['file_path'];

//             $downloadUrl = "https://api.telegram.org/file/bot{$token}/{$filePath}";
//             $fileContent = Http::get($downloadUrl)->body();

//             $photo = FileUploadService::upload($fileContent, basename($filePath), 'telegram');

//             // dd($response->json()['result']['file_path']);
//             if ($photo['success']) {
//                 Image::create(['product_id' => $product->id, 'path' => $photo['path']]);
//                 // info("file", [$photo['path']]);
//             }
// //avelacnel shat photoner
//             DB::commit();

//             // info("text", [$allData['text']]);
//             // info("photo", [$allData['photos']]);
//             // info("caption", [$allData['caption']]);
//             // info("textextt", [$this->message->toArray()]);

//         } catch (\Exception $e) {
//             info("Exception", [$e->getMessage()]);
//             DB::rollBack();
//         } catch (\Error $e) {
//             info("error", [$e->getMessage()]);
//             DB::rollBack();
//         }
//         $this->reply("Success");
    }

    public function help(): void
    {
        $this->reply('*!Hello help*');
    }

    public function actions(): void
    {
        info('action');
        // $url = 'https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/getUpdates';

        //working variant
        // Http::post('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/sendMessage', [
        //     'chat_id' => -4265397495,
        //     'text' => "Both sended message",
        // ]);

        // Http::post('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') .'/deleteWebhook');
// info('url', [$url]);
//         $response = Http::get($url);
//         $text = $response->getBody()->getContents();
//         info('text', [$text]);

        // $fileId = 'AgACAgIAAxkBAAPtZl8I0duwyvvFJDsTc0BdBa9dC4kAAt_aMRtjR8lKUJ_VnsJ90iQBAAMCAAN5AAM1BA';
        // $token = env('TELEGRAM_BOT_TOKEN');
        // $getFileUrl = "https://api.telegram.org/bot{$token}/getFile?file_id={$fileId}";

        // $response = Http::get($getFileUrl);
        // $filePath = $response->json()['result']['file_path'];

        // $downloadUrl = "https://api.telegram.org/file/bot{$token}/{$filePath}";
        // $fileContent = Http::get($downloadUrl)->body();



        // $fileName = basename($filePath);
        // Storage::put("telegram/{$fileName}", $fileContent);



        // info('filePath', [$filePath]);


        // https://api.telegram.org/bot7107824182:AAEpGRYcb1kMGvybkL8sG7tvFWYr0QqVfIw/getUpdates
        // getMessages#63c66506


        // $response = Http::get('https://api.telegram.org/bot' . env('TELEGRAM_BOT_TOKEN') . '/getUpdates', [
        //     'chat_id' => -4265397495,
        // ]);

        // if ($response->successful()) {
        //     $data = json_decode($response->getBody(), true);
        //     if ($data['ok']) {
        //         $messages = $data['result']['messages'];
        //         info('messages', $messages);
        //     } else {
        //         info('error', $data['description']);
        //     }
        // } else {
        //     info('error', 'HTTP request failed');
        // }


        // $this->reply('*sdasdasd*');

        // $chatId = '-4265397495';
        // info("info", [Telegraph::botInfo()->send()]);

        // Telegraph::bot('default')
        //     ->chat($chatId)
        //     ->message("Choose action")
        //     ->keyboard(
        //         Keyboard::make()->buttons([
        //             Button::make('Visit Website')->url("https://defstudio.it"),
        //             Button::make('Like')->action("like"),
        //             Button::make('Subscribe')->action("subscribe"),
        //         ])
        //     )->send();
        // info("info", [Telegraph::botInfo()->send()]);
        // Telegraph::markdownV2('*hello* world')->send();


        // Telegraph::message("Choose action")
        //     ->keyboard(
        //         Keyboard::make()->buttons([
        //             Button::make('Visit Website')->url("https://defstudio.it"),
        //             Button::make('Like')->action("like"),
        //             Button::make('Subscribe')->action("subscribe"),
        //         ])
        //     )->send();

        // Telegraph::sendMessage([
        //         'chat_id' => '-4265397495', // Идентификатор чата
        //         'text' => 'hello world'
        //     ]);


    }
}