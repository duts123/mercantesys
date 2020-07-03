<?php

use Illuminate\Database\Seeder;

class RProductInfosTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('r_product_infos')->delete();
        
        \DB::table('r_product_infos')->insert(array (
            0 => 
            array (
                'PROD_ID' => 1,
                'PRODT_ID' => 6,
                'AFF_ID' => 2,
                'PROD_DESC' => 'One Dozen White Roses + Three Red Roses',
                'PROD_NOTE' => '<p><strong>Be my Valentine!&nbsp; Can&#39;t decide between 3 red roses or 1 dozen roses?&nbsp; Send her both! Celebrate Valentine&#39;s day by sending her three beautiful red roses surrounded by a dozen white roses.&nbsp; The perfect Valentine&#39;s Day surprise!</strong></p>

<p>Flowers are arranged and shipped in exclusive Island Rose packaging. Vase is not included. Special add-on gift items are available upon checkout.<br />
Absolutely no hidden fees! For your convenience, all our prices already include Service Charges, Taxes, and Delivery Fees. Happy Shopping!&nbsp;</p>

<p>*Our priority is to deliver your flowers on time!&nbsp; If certain flowers unexpectedly become unavailable, Island Rose will replace them with flowers of equal or greater value.<br />
**Island Rose offers next day delivery nationwide! Same day delivery is available in Metro Manila.</p>',
                'PROD_IMG' => 'uploads/2019-ISL-00002-1.jpg',
                'PROD_CODE' => '2019-ISL-00002-1',
                'PROD_NAME' => 'Be My Valentine!',
                'PROD_INIT_QTY' => 500,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 100,
                'PROD_BASE_PRICE' => 1890.0,
                'PROD_MY_PRICE' => 2100.0,
                'PROD_AVAILABILITY' => NULL,
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-20 05:39:14',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:44',
                'updated_at' => '2019-02-24 15:25:35',
            ),
            1 => 
            array (
                'PROD_ID' => 2,
                'PRODT_ID' => 6,
                'AFF_ID' => 2,
                'PROD_DESC' => '3-Stem White Roses',
                'PROD_NOTE' => '<strong>White roses are meant to reaffirm one&#39;s commitment, fidelity </strong><strong>and</strong><strong> loyalty. Write your message in our special Island Rose greeting card and we&#39;ll send it with long stem white roses. Express your deepest feelings - say it best with roses!<br />
Flowers are arranged in exclusive Island Rose packaging and delivered in special gift boxes.</strong><strong>Vase</strong><strong> is not included. Special add-on gift items are available upon checkout.</strong><br />
<br />
Absolutely no hidden fees! For your convenience, all our prices already include Service Charges, Taxes, and Delivery fees. Happy Shopping!&nbsp;<br />
*Our priority is to deliver your flowers on time!&nbsp; If certain flowers unexpectedly become unavailable, Island Rose will replace them with flowers of equal or greater value.<br />
<br />
**Island Rose offers next day delivery nationwide! Same day delivery is available in Metro Manila.',
                'PROD_IMG' => 'uploads/2019-ISL-00002-2.jpg',
                'PROD_CODE' => '2019-ISL-00002-2',
                'PROD_NAME' => 'Pure White',
                'PROD_INIT_QTY' => 500,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 100,
                'PROD_BASE_PRICE' => 695.0,
                'PROD_MY_PRICE' => 700.0,
                'PROD_AVAILABILITY' => '02/17/2019 to 02/28/2019',
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-20 05:22:02',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:44',
                'updated_at' => '2019-02-21 16:04:10',
            ),
            2 => 
            array (
                'PROD_ID' => 3,
                'PRODT_ID' => 4,
                'AFF_ID' => 1,
                'PROD_DESC' => 'One Dozen Red Roses, Teddy Bear, Pralines',
                'PROD_NOTE' => '<p><strong>Wake her up to a lovely surprise! There&#39;s no gift sweeter than a fresh bunch of flowers together with a box of chocolates and a bear that says &quot;I Love You&quot;. Let this special day be a reminder of how much you love her. Whether it&#39;s your anniversary, her birthday or just an ordinary day - let this intimate gift package say your deepest feelings!<br />
Flowers are arranged in exclusive Island Rose packaging and delivered in special gift boxes. Special add-on gift items are available upon checkout.</strong></p>

<p>Absolutely no hidden fees! For your convenience, all our prices already include Service Charges, Taxes, and Delivery fees. Happy Shopping!&nbsp; *Our priority is to deliver your flowers on time!&nbsp; If certain flowers unexpectedly become unavailable, Island Rose will replace them with flowers of equal or greater value.**Island Rose offers next day delivery nationwide! Same day delivery is available in Metro Manila.</p>',
                'PROD_IMG' => 'uploads/2019-SYM-00001-3.jpg',
                'PROD_CODE' => '2019-SYM-00001-3',
                'PROD_NAME' => 'Forever',
                'PROD_INIT_QTY' => 500,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 100,
                'PROD_BASE_PRICE' => 1000.0,
                'PROD_MY_PRICE' => 1200.0,
                'PROD_AVAILABILITY' => NULL,
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-20 03:53:20',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:44',
                'updated_at' => '2019-02-23 02:04:14',
            ),
            3 => 
            array (
                'PROD_ID' => 4,
                'PRODT_ID' => 6,
                'AFF_ID' => 2,
                'PROD_DESC' => 'White & Orange Roses In An Orange Keepsake Box',
                'PROD_NOTE' => '<strong>The sweetest rose combination for the special people in your life. Send a box of cheerful orange and white roses - a flawless fit for happy occasions!<br />
Absolutely no hidden fees! For your convenience, all our prices already include Service Charges, Taxes, and Delivery Fees. Happy Shopping!&nbsp;</strong><br />
<p>*Our priority is to deliver your flowers on time! If certain flowers unexpectedly become unavailable, Island Rose will replace them with flowers of equal or greater value.</p>

<p>**Island Rose offers next day delivery nationwide! Same day delivery is available to most of Metro Manila except CAMANAVA (Caloocan, Malabon, Navotas, and Valenzuela).</p>',
                'PROD_IMG' => 'uploads/2019-SYM-00001-4.jpg',
                'PROD_CODE' => '2019-SYM-00001-4',
                'PROD_NAME' => 'Orange Candy Rose',
                'PROD_INIT_QTY' => 500,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 100,
                'PROD_BASE_PRICE' => 1000.0,
                'PROD_MY_PRICE' => 1200.0,
                'PROD_AVAILABILITY' => NULL,
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-21 15:32:21',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-19 05:43:44',
                'updated_at' => '2019-02-21 16:09:56',
            ),
            4 => 
            array (
                'PROD_ID' => 5,
                'PRODT_ID' => 9,
                'AFF_ID' => 2,
                'PROD_DESC' => 'One Dozen White Roses and White Messenger Bear™',
                'PROD_NOTE' => '<strong>The Love and Blooms package is made up of a dozen white roses and a white Messenger Bear</strong><strong>&trade; .</strong><strong>&nbsp;</strong>

<p><br />
The white rose variety used in this arrangement is imported from Europe and grown in the most sophisticated flower farm in the Philippines.&nbsp;<br />
Our 12 inch Messenger Bear&trade; is made with high quality ivory white fabric, stuffed with a very soft material, and all wrapped up in a shirt with your message of love.&nbsp;<br />
The Love and Blooms package comes in exclusive Island Rose packaging for delivery anywhere in the Philippines.</p>',
                'PROD_IMG' => 'uploads/2019-ISL-00002-5.jpg',
                'PROD_CODE' => '2019-ISL-00002-5',
                'PROD_NAME' => 'Love and Blooms',
                'PROD_INIT_QTY' => 100,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 50,
                'PROD_BASE_PRICE' => 3379.0,
                'PROD_MY_PRICE' => 3500.0,
                'PROD_AVAILABILITY' => NULL,
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-22 00:59:10',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 00:59:10',
                'updated_at' => '2019-02-22 00:59:10',
            ),
            5 => 
            array (
                'PROD_ID' => 6,
                'PRODT_ID' => 6,
                'AFF_ID' => 2,
                'PROD_DESC' => 'One Dozen Red Roses, Open Heart Pendant, and Belgian Chocolate Bars',
                'PROD_NOTE' => '<h3><strong>The SweetHeart Blooms package is made of a dozen red roses, a sterling silver open heart pendant with necklace, and Belgian chocolate bars.&nbsp;</strong></h3>

<p><br />
The red rose variety used in this arrangement is imported from Europe and grown in the most sophisticated flower farm in the Philippines.&nbsp;<br />
The Open Heart pendant is made of sterling silver and comes with an 18-inch chain also in sterling silver. This set will arrive in a custom jewelry box tied with a satin ribbon appropriate to the season.&nbsp;<br />
The delighful set of Belgian chocolate bars are made only with the finest ingredients from exclusive local and international suppliers.&nbsp;<br />
The SweetHeart Blooms package comes in exclusive Island Rose packaging for delivery anywhere in the Philippines.</p>

<p>&nbsp;</p>',
                'PROD_IMG' => 'uploads/2019-ISL-00002-6.jpg',
                'PROD_CODE' => '2019-ISL-00002-6',
                'PROD_NAME' => 'SweetHeart Blooms',
                'PROD_INIT_QTY' => 100,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 50,
                'PROD_BASE_PRICE' => 4429.0,
                'PROD_MY_PRICE' => 4500.0,
                'PROD_AVAILABILITY' => NULL,
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-22 01:00:56',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 01:00:56',
                'updated_at' => '2019-02-22 07:34:37',
            ),
            6 => 
            array (
                'PROD_ID' => 7,
                'PRODT_ID' => 6,
                'AFF_ID' => 2,
                'PROD_DESC' => 'Five 3-Stem Rose Bouquets',
                'PROD_NOTE' => '<strong>The Group Hug package is made of five 3-stem bouquets in five different </strong><strong>colours</strong><strong>.&nbsp;</strong>

<p><br />
The rose varieties used in this arrangement are imported from Europe and grown in the most sophisticated flower farm in the Philippines.&nbsp;<br />
The Group Hug package comes in exclusive Island Rose packaging for delivery anywhere in the Philippines.</p>

<p>&nbsp;</p>',
                'PROD_IMG' => 'uploads/2019-ISL-00002-7.jpg',
                'PROD_CODE' => '2019-ISL-00002-7',
                'PROD_NAME' => 'Group Hug',
                'PROD_INIT_QTY' => 100,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 10,
                'PROD_BASE_PRICE' => 3199.0,
                'PROD_MY_PRICE' => 3500.0,
                'PROD_AVAILABILITY' => NULL,
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-22 01:02:32',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 01:02:32',
                'updated_at' => '2019-02-22 01:02:32',
            ),
            7 => 
            array (
                'PROD_ID' => 8,
                'PRODT_ID' => 6,
                'AFF_ID' => 2,
                'PROD_DESC' => 'Classic Black Rose Gift Box and Limited Edition Rajo! Greeting Cards',
                'PROD_NOTE' => '<strong>The Thoughts of Love package is made of the Classic Black Rose Gift Box and a set of 10 limited </strong><strong>edition</strong><strong> Rajo! Greeting Cards.&nbsp;</strong>

<p><br />
The red and white rose varieties used in this arrangement are imported from Europe and grown in the most sophisticated flower farm in the Philippines.&nbsp;<br />
The Thoughts of Love package comes in exclusive Island Rose packaging for delivery anywhere in the Philippines.</p>',
                'PROD_IMG' => 'uploads/2019-ISL-00002-8.jpg',
                'PROD_CODE' => '2019-ISL-00002-8',
                'PROD_NAME' => 'Thoughts of Love',
                'PROD_INIT_QTY' => 100,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 10,
                'PROD_BASE_PRICE' => 2989.0,
                'PROD_MY_PRICE' => 3000.0,
                'PROD_AVAILABILITY' => NULL,
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-22 01:05:44',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 01:05:44',
                'updated_at' => '2019-02-22 01:05:44',
            ),
            8 => 
            array (
                'PROD_ID' => 9,
                'PRODT_ID' => 5,
                'AFF_ID' => 2,
                'PROD_DESC' => 'One Dozen Red Roses & Pralines',
                'PROD_NOTE' => '<p>Flowers and chocolates when combined becomes the sweetest gift. Any one will be surprised and turned on by this special gift package composed of a bunch of farm fresh flowers and a box of classic truffles and praline chocolates. The red roses used in our this fresh bouquet are imported from Europe and grown in the most sophisticated flower farm in the Philippines. The C Collection Bruges Belgian Chocolates are made only with the finest ingredients from exclusive local and international suppliers. Every box of this chocolate goodness together with the bouquet of flowers comes in special Island Rose packaging with greeting card for personalized message, available for delivery anywhere in the Philippines.</p>',
                'PROD_IMG' => 'uploads/2019-ISL-00002-9.jpg',
                'PROD_CODE' => '2019-ISL-00002-9',
                'PROD_NAME' => 'Sweet Fantasy',
                'PROD_INIT_QTY' => 100,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 10,
                'PROD_BASE_PRICE' => 2509.0,
                'PROD_MY_PRICE' => 3000.0,
                'PROD_AVAILABILITY' => NULL,
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-22 01:07:48',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 01:07:48',
                'updated_at' => '2019-02-22 01:07:48',
            ),
            9 => 
            array (
                'PROD_ID' => 10,
                'PRODT_ID' => 10,
                'AFF_ID' => 2,
                'PROD_DESC' => 'Caramel Chocolate Pralines',
                'PROD_NOTE' => '<p>A dozen-piece collection specifically concocted for caramel lovers, the C Collection is made up of six 64 percent dark chocolate-covered vanilla-flavored caramel and six espresso-infused 43 percent milk chocolate-covered caramel. These different flavors of chocolate caramels are meant to entice the palate at every bite.</p>

<p>Our C Collection Bruges Belgian Chocolates are made only with the finest ingredients from exclusive local and international suppliers. Every box of this chocolate goodness comes in a special Island Rose packaging with greeting card for personalized message, available for delivery anywhere in the Philippines.</p>',
                'PROD_IMG' => 'uploads/2019-ISL-00002-10.jpg',
                'PROD_CODE' => '2019-ISL-00002-10',
                'PROD_NAME' => 'The C Collection',
                'PROD_INIT_QTY' => 100,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 10,
                'PROD_BASE_PRICE' => 1059.0,
                'PROD_MY_PRICE' => 1500.0,
                'PROD_AVAILABILITY' => NULL,
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-22 01:10:31',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 01:10:31',
                'updated_at' => '2019-02-22 01:10:31',
            ),
            10 => 
            array (
                'PROD_ID' => 11,
                'PRODT_ID' => 11,
                'AFF_ID' => 1,
                'PROD_DESC' => 'Teddy Bear with Customised Message',
                'PROD_NOTE' => '<p>Made with finest fabric and stuffing, our 12 inch Messenger Bear&trade; features a soft light brown textile coupled with hand-embroidered messages. Ranging from the classic &quot;I Love You&quot; shirt to simple &quot;Thank You&quot; shirt, this cute and lovable stuffed toy can assist you on saying those words of endearment or any simple greetings. Choose from a list of readily available shirt messages and we&#39;ll take care of the rest.</p>

<p>Each Messenger Bear&trade; Light Brown comes in premium Island Rose gift packaging for delivery anywhere in the Philippines.</p>',
                'PROD_IMG' => 'uploads/2019-SYM-00001-11.jpg',
                'PROD_CODE' => '2019-SYM-00001-11',
                'PROD_NAME' => 'Messenger Bear™ Light Brown',
                'PROD_INIT_QTY' => 100,
                'PROD_DISCOUNT' => 0,
                'PROD_CRITICAL' => 10,
                'PROD_BASE_PRICE' => 1069.0,
                'PROD_MY_PRICE' => 1500.0,
                'PROD_AVAILABILITY' => NULL,
                'PROD_IS_APPROVED' => 1,
                'PROD_APPROVED_AT' => '2019-02-22 01:29:55',
                'PROD_DISPLAY_STATUS' => 1,
                'created_at' => '2019-02-22 01:29:55',
                'updated_at' => '2019-02-24 16:14:53',
            ),
        ));
        
        
    }
}