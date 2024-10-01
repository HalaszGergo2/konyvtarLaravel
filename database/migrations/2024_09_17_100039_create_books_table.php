<?php

use App\Models\Book;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('book_id');
            $table->string('author');
            $table->string('title');
            $table->timestamps();
        });

        Book::create(['author'=>'Shakespear',
         'title'=> 'Spear',
        ]);

        Book::create(['author'=>'James bond',
         'title'=> 'Mission',
        ]);

        Book::create(['author'=>'John Flaggan',
         'title'=> 'Umbra',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
