<?php

use App\Core\Schema;
use App\Core\Migration;

class CreateTableStarRatingIp extends Migration
{
    /**
     * Запуск миграций
     * Нужно вызвать метод класса Schema
     * Schema::operation('create', 'tableName', [
     *     'id int(11) not null primary key auto_increment',
     * ]));
     *
     * @return void
     */
    public function up() 
    {
        Schema::operation('create', 'star_rating_ip', [
            'id int(11) unsigned not null primary key auto_increment',
            'rating_id int(11) unsigned not null',
            'rating_value tinyint(2) unsigned not null',
            'rating_ip varchar(16) not null default "0.0.0.0"'
        ]);
    }
    
    /**
     * Отменяет миграцию
     *
     * @return void
     */
    public function down() 
    {
        Schema::operation('drop', 'star_rating_ip');
    }
}