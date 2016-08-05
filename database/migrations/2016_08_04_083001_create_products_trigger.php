<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::unprepared('
        CREATE TRIGGER `products_AFTER_INSERT` AFTER INSERT ON `products` FOR EACH ROW
        BEGIN
        	declare cate_name text;
            declare search_text text;

        	set @cate_name := (
        		SELECT `categories`.`name`
                FROM `categories`
                JOIN `products`
        			ON `products`.`category_id` = `categories`.`id`
        		WHERE `products`.`id` = NEW.`id` LIMIT 1);

        	set @search_text := if(@cate_name is not null, CONCAT(NEW.`name`, \' \', @cate_name), NEW.`name`);

            INSERT INTO `search_products` (`product_id`, `search_text`, `created_at`, `updated_at`)
            VALUES (
        		NEW.`id`,
                @search_text,
                NEW.`created_at`,
                NEW.`updated_at`);
        END
        ');
        DB::unprepared('
        CREATE TRIGGER `products_AFTER_UPDATE` AFTER UPDATE ON `products` FOR EACH ROW
            BEGIN
                declare cate_name text;
                declare search_text text;

                set @cate_name := (
                    SELECT `categories`.`name`
                    FROM `categories`
                    JOIN `products`
                        ON `products`.`category_id` = `categories`.`id`
                    WHERE `products`.`id` = NEW.`id` LIMIT 1);

                set @search_text := if(@cate_name is not null, CONCAT(NEW.`name`, \' \', @cate_name), NEW.`name`);

                UPDATE `search_products`
                SET
                    `product_id` =  NEW.`id`,
                    `search_text` = @search_text,
                    `created_at` = NEW.`created_at`,
                    `updated_at` = NEW.`updated_at`
                WHERE `product_id` = NEW.`id`;
            END
        ');
        DB::unprepared('
        CREATE TRIGGER `products_AFTER_DELETE` AFTER DELETE ON `products` FOR EACH ROW
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
        DB::unprepared('DROP TRIGGER `products_AFTER_INSERT`');
        DB::unprepared('DROP TRIGGER `products_AFTER_UPDATE`');
        DB::unprepared('DROP TRIGGER `products_AFTER_DELETE`');
    }
}
