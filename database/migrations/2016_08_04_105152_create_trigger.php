<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrigger extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('ALTER TABLE search_products ADD FULLTEXT(`search_text`)');
        DB::unprepared('
          CREATE TRIGGER `products_AINS` AFTER INSERT ON `products` FOR EACH ROW
              BEGIN
                  DECLARE search_text text;
                  DECLARE category_name text;
                  
                  SET @category_name := (
                      SELECT c.name 
                      FROM products p 
                          join categories c 
                          on p.category_id = c.id 
                      where p.id = NEW.`id`
                      limit 1
                  );
                  
                  SET @search_text := CONCAT(NEW.`name`, \' \', @category_name);
                  INSERT INTO `search_products` (`product_id`, `search_text`, `created_at`, `updated_at`)
                  VALUES (
                      NEW.`id`,
                      @search_text,
                      NEW.`created_at`,
                      NEW.`updated_at`
                  );
              END
        ');
        
        DB::unprepared('
            CREATE TRIGGER `products_AUPD` AFTER UPDATE ON `products` FOR EACH ROW
                BEGIN
                    DECLARE search_text text;
                    DECLARE category_name text;
                    
                    SET @category_name := (
                        SELECT c.name 
                        FROM products p 
                            join categories c 
                            on p.category_id = c.id 
                        where p.id = NEW.`id`
                        limit 1
                    );
                    
                    SET @search_text := CONCAT(NEW.`name`, \' \', @category_name);
                    UPDATE `search_products`
                    set search_text = @search_text
                    where `product_id` = NEW.`id`;
                END
        ');
        
        DB::unprepared('
            CREATE TRIGGER `products_ADEL` AFTER DELETE ON `products` FOR EACH ROW
                BEGIN
                    DELETE FROM `search_products`
                    where `product_id` = OLD.`id`;
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
        DB::unprepared('DROP TRIGGER `products_AINS`');
        DB::unprepared('DROP TRIGGER `products_AUPD`');
        DB::unprepared('DROP TRIGGER `products_ADEL`');
    }
}
