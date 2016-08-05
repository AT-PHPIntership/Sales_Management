<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoriesTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        DB::unprepared('
        CREATE TRIGGER `categories_AFTER_INSERT` AFTER INSERT ON `categories` FOR EACH ROW
        BEGIN
        	DECLARE product_name TEXT;
            DECLARE search_text TEXT;

        	SET @product_name := (
        		SELECT `products`.`name`
                FROM `products`
                JOIN `categories`
        			ON `products`.`category_id` = `categories`.`id`
        		WHERE `categories`.`id` = NEW.`id` LIMIT 1);

        	SET @search_text := IF(@product_name IS NOT NULL, CONCAT(NEW.`name`, \' \', @product_name), NEW.`name`);

            INSERT INTO `search_products` (`product_id`, `search_text`, `created_at`, `updated_at`)
            VALUES (
        		NEW.`id`,
                @search_text,
                NEW.`created_at`,
                NEW.`updated_at`);
        END
        ');
         */
        DB::unprepared('
        CREATE TRIGGER `categories_AFTER_UPDATE` AFTER UPDATE ON `categories` FOR EACH ROW
            BEGIN
                DECLARE product_name TEXT;
                DECLARE search_text TEXT;

            	SET @product_name := (
            		SELECT `products`.`name`
                    FROM `products`
                    JOIN `categories`
            			ON `products`.`category_id` = `categories`.`id`
            		WHERE `categories`.`id` = NEW.`id` LIMIT 1);

            	SET @search_text := IF(@product_name IS NOT NULL, CONCAT(NEW.`name`, \' \', @product_name), NEW.`name`);

                    UPDATE `search_products`
                    SET
                        `product_id` =  NEW.`id`,
                        `search_text` = @search_text,
                        `created_at` = NEW.`created_at`,
                        `updated_at` = NEW.`updated_at`
                    WHERE `product_id` IN (SELECT products.id FROM products JOIN `categories` ON `products`.`category_id` = NEW.`id`);
            END
        ');
        DB::unprepared('
        CREATE TRIGGER `categories_AFTER_DELETE` AFTER DELETE ON `categories` FOR EACH ROW
            BEGIN
                DELETE FROM `search_products`
                WHERE `product_id` = OLD.`id`;
            END
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // DB::unprepared('DROP TRIGGER `categories_AFTER_INSERT`');
        DB::unprepared('DROP TRIGGER `categories_AFTER_UPDATE`');
        DB::unprepared('DROP TRIGGER `categories_AFTER_DELETE`');
    }
}
