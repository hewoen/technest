<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;


class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //         Product::factory()->create([
        //             'id' => 4,
        //             'name' => 'iPhone X',
        //             'description' => '<p><strong>Eleganz trifft Innovation</strong></p>
        // <p>Erleben Sie mit dem iPhone X eine neue &Auml;ra der Smartphone-Technologie. Das randlose 5,8" Super Retina OLED-Display sorgt f&uuml;r brillante Farben und beeindruckende Kontraste. Face ID erm&ouml;glicht sichere und einfache Entsperrung per Gesichtserkennung. Der A11 Bionic Chip bietet herausragende Performance, ideal f&uuml;r anspruchsvolle Apps und Gaming. Mit der 12 MP Dual-Kamera gelingen Ihnen gestochen scharfe Fotos und beeindruckende Portr&auml;ts. Entdecken Sie Premium-Design aus Glas und Edelstahl, kombiniert mit drahtlosem Laden und langlebiger Akkuleistung &ndash; ein Smartphone, das Ma&szlig;st&auml;be setzt.</p>',
        //             'price' => 200,
        //             'stock' => 100,
        //             'created_at' => '2024-12-05 10:51:12',
        //             'updated_at' => '2024-12-08 09:22:29'
        //         ],
        //         [
        //             'id' => 5,
        //             'name' => 'iPad Pro',
        //             'description' => '<h3><strong>Leistung trifft auf Eleganz</strong></h3>
        // <p>Das <strong>iPad Pro</strong> ist Apples bislang leistungsst&auml;rkstes Tablet, ausgestattet mit dem revolution&auml;ren <strong>M4-Chip</strong>, der professionelle Anwendungen wie Video-Rendering, KI-basierte Aufgaben und grafikintensive Spiele m&uuml;helos bew&auml;ltigt. Die <strong>Neural Engine</strong> schafft bis zu <strong>38 Billionen Rechenoperationen pro Sekunde</strong>, was es zu einem idealen Ger&auml;t f&uuml;r Entwickler, Kreative und Power-User macht.</p>
        // <p>Mit einem atemberaubenden <strong>Liquid Retina Display</strong> in <strong>11 Zoll</strong> oder <strong>13 Zoll</strong>, True Tone und einer Antireflex-Beschichtung bietet es eine unvergleichliche visuelle Erfahrung. Die neue <strong>12 MP Ultraweitwinkel-Frontkamera</strong> ist perfekt f&uuml;r Videokonferenzen im Querformat, w&auml;hrend die leistungsstarken <strong>Pro-Kameras</strong> gestochen scharfe Fotos und Videos liefern.</p>
        // <p>Das iPad Pro unterst&uuml;tzt den innovativen <strong>Apple Pencil Pro</strong> f&uuml;r pr&auml;zises Zeichnen und Notizen sowie das <strong>Magic Keyboard</strong>, das das Tablet in einen leistungsstarken Laptop verwandelt. Mit der Unterst&uuml;tzung von Thunderbolt und vielseitigen KI-Frameworks ist es die perfekte Kombination aus Produktivit&auml;t, Kreativit&auml;t und Mobilit&auml;t.</p>
        // <p>&nbsp;</p>',
        //             'price' => 1000.00,
        //             'stock' => 100,
        //             'created_at' => '2024-12-05 13:11:42',
        //             'updated_at' => '2024-12-07 19:38:36'
        //         ],
        //         [
        //             'id' => 6,
        //             'name' => 'Smartwatch',
        //             'description' => '<p><strong>Ihr smarter Begleiter f&uuml;r Alltag und Fitness</strong><br>Diese moderne Smartwatch vereint Stil und Funktionalit&auml;t in einem kompakten Ger&auml;t. Das brillante Touch-Display liefert alle wichtigen Informationen auf einen Blick, w&auml;hrend Funktionen wie Herzfrequenzmessung, Schrittz&auml;hler und Schlaf&uuml;berwachung Ihre Gesundheit im Blick halten. Dank GPS und verschiedenen Sportmodi ist sie der ideale Partner f&uuml;r Ihr Training. Bleiben Sie vernetzt: Empfangen Sie Anrufe, Nachrichten und Benachrichtigungen direkt am Handgelenk. Mit einer langen Akkulaufzeit, wasserdichtem Design und individuell anpassbaren Zifferbl&auml;ttern passt sich diese Smartwatch perfekt an Ihren Alltag an. Ein Must-have f&uuml;r Technikliebhaber und Fitnessbegeisterte!</p>',
        //             'price' => 100.00,
        //             'stock' => 100,
        //             'created_at' => '2024-12-07 19:37:48',
        //             'updated_at' => '2024-12-07 19:37:48'
        //         ]
        //         );

        //         ProductImage::factory()



        DB::statement("INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `created_at`, `updated_at`) VALUES (4, 'iPhone 16 Pro', '<p><strong>Innovation in Perfektion</strong></p>\r\n<p>Erleben Sie das iPhone 16 Pro mit seinem robusten und zugleich leichten Design aus Titan in vier beeindruckenden Farben, darunter das neue Desert Titanium. Das Super Retina XDR Display bietet mit 6,3 Zoll eine brillante Darstellung, w&auml;hrend das iPhone 16 Pro Max mit 6,9 Zoll das gr&ouml;&szlig;te iPhone-Display aller Zeiten pr&auml;sentiert. Der leistungsstarke A18 Pro Chip sorgt f&uuml;r herausragende Performance und Effizienz, ideal f&uuml;r anspruchsvolle Anwendungen und Spiele.Das neue 48-Megapixel-Fusion-Kamerasystem mit 5-fachem optischen Zoom erm&ouml;glicht beeindruckende Fotos und Videos in 4K mit 120 fps Dolby Vision.Innovative Funktionen wie die Kamera-Steuerung und der Action Button bieten eine intuitive Bedienung und erweitern Ihre kreativen M&ouml;glichkeiten.Mit einer deutlich verl&auml;ngerten Akkulaufzeit begleitet Sie das iPhone 16 Pro zuverl&auml;ssig durch den Tag. Entdecken Sie das iPhone 16 Pro &ndash; ein Meisterwerk der Technologie und des Designs.</p>', 200.00, 100, '2024-12-05 10:51:12', '2024-12-20 09:34:02')");
        DB::statement("INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `created_at`, `updated_at`) VALUES (5, 'iPad Pro', '<h3><strong>Leistung trifft auf Eleganz</strong></h3>\r\n<p>Das <strong>iPad Pro</strong> ist Apples bislang leistungsst&auml;rkstes Tablet, ausgestattet mit dem revolution&auml;ren <strong>M4-Chip</strong>, der professionelle Anwendungen wie Video-Rendering, KI-basierte Aufgaben und grafikintensive Spiele m&uuml;helos bew&auml;ltigt. Die <strong>Neural Engine</strong> schafft bis zu <strong>38 Billionen Rechenoperationen pro Sekunde</strong>, was es zu einem idealen Ger&auml;t f&uuml;r Entwickler, Kreative und Power-User macht.</p>\r\n<p>Mit einem atemberaubenden <strong>Liquid Retina Display</strong> in <strong>11 Zoll</strong> oder <strong>13 Zoll</strong>, True Tone und einer Antireflex-Beschichtung bietet es eine unvergleichliche visuelle Erfahrung. Die neue <strong>12 MP Ultraweitwinkel-Frontkamera</strong> ist perfekt f&uuml;r Videokonferenzen im Querformat, w&auml;hrend die leistungsstarken <strong>Pro-Kameras</strong> gestochen scharfe Fotos und Videos liefern.</p>\r\n<p>Das iPad Pro unterst&uuml;tzt den innovativen <strong>Apple Pencil Pro</strong> f&uuml;r pr&auml;zises Zeichnen und Notizen sowie das <strong>Magic Keyboard</strong>, das das Tablet in einen leistungsstarken Laptop verwandelt. Mit der Unterst&uuml;tzung von Thunderbolt und vielseitigen KI-Frameworks ist es die perfekte Kombination aus Produktivit&auml;t, Kreativit&auml;t und Mobilit&auml;t.</p>\r\n<p>&nbsp;</p>', 1000.00, 100, '2024-12-05 13:11:42', '2024-12-07 19:38:36')");
        DB::statement("INSERT INTO `products` (`id`, `name`, `description`, `price`, `stock`, `created_at`, `updated_at`) VALUES (8, 'Smartwatch', '<p><strong>Ihr smarter Begleiter f&uuml;r Alltag und Fitness</strong><br>Diese moderne Smartwatch vereint Stil und Funktionalit&auml;t in einem kompakten Ger&auml;t. Das brillante Touch-Display liefert alle wichtigen Informationen auf einen Blick, w&auml;hrend Funktionen wie Herzfrequenzmessung, Schrittz&auml;hler und Schlaf&uuml;berwachung Ihre Gesundheit im Blick halten. Dank GPS und verschiedenen Sportmodi ist sie der ideale Partner f&uuml;r Ihr Training. Bleiben Sie vernetzt: Empfangen Sie Anrufe, Nachrichten und Benachrichtigungen direkt am Handgelenk. Mit einer langen Akkulaufzeit, wasserdichtem Design und individuell anpassbaren Zifferbl&auml;ttern passt sich diese Smartwatch perfekt an Ihren Alltag an. Ein Must-have f&uuml;r Technikliebhaber und Fitnessbegeisterte!</p>', 100.00, 100, '2024-12-07 19:37:48', '2024-12-07 19:37:48')");
        File::copyDirectory(storage_path('products'), public_path('storage/uploads'));

        DB::statement("INSERT INTO `product_images` (`id`, `product_id`, `path`, `position`, `created_at`, `updated_at`) VALUES (5, 5, '/storage/uploads/ueewZ2ZWWwhMlpEzZT0chZG3W3SgCA8j11LTN37i.jpg', 1000, '2024-12-05 13:11:43', '2024-12-05 13:11:43')");
        DB::statement("INSERT INTO `product_images` (`id`, `product_id`, `path`, `position`, `created_at`, `updated_at`) VALUES (13, 8, '/storage/uploads/kquFL7B7FsmY5TbbOzMUpGs48kj00ZFan34IlY0I.jpg', 1000, '2024-12-07 19:37:48', '2024-12-07 19:37:48')");
        DB::statement("INSERT INTO `product_images` (`id`, `product_id`, `path`, `position`, `created_at`, `updated_at`) VALUES (14, 4, '/storage/uploads/BDf5Q8uQFwNM6vJDHxS9OJHNLPEPIpkzG4cnSBlj.jpg', 0, '2024-12-20 09:25:50', '2024-12-20 09:28:37')");
        DB::statement("INSERT INTO `product_images` (`id`, `product_id`, `path`, `position`, `created_at`, `updated_at`) VALUES (15, 4, '/storage/uploads/cHPYyBufGPSILWwHcfZTggV9QmBb6JwzDnxrL2FK.jpg', 1, '2024-12-20 09:25:50', '2024-12-20 09:28:37')");
        DB::statement("INSERT INTO `product_images` (`id`, `product_id`, `path`, `position`, `created_at`, `updated_at`) VALUES (16, 4, '/storage/uploads/YPmR35r5NRpEFzW7H3wVO22wlEDc3fDCSAF8wWZK.jpg', 2, '2024-12-20 09:25:50', '2024-12-20 09:28:37')");
        
    }
}
