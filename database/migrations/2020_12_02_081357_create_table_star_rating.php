<?php

use App\Core\Schema;
use App\Core\Migration;

class CreateTableStarRating extends Migration
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
        Schema::operation('create', 'star_rating', [
            'id int(11) unsigned not null primary key auto_increment',
            'rating_id varchar(20) not null',
            'rating_avg float not null',
            'total_votes int(11) unsigned not null'
        ]);
    }
    
    /**
     * Отменяет миграцию
     *
     * @return void
     */
    public function down() 
    {
        Schema::operation('drop', 'star_rating');
    }
}