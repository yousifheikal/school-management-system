<?php

namespace Database\Seeders;

use App\Models\My_Parent;
use App\Models\Nationality;
use App\Models\Religion;
use App\Models\Type_Blood;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ParentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        DB::table('my__parents')->delete();
        $my_parents = new My_Parent();
        $my_parents->email = 'hani77@yahoo.com';
        $my_parents->password = Hash::make('01004121711');
        $my_parents->Name_Father = ['en' => 'Hani Mohamed', 'ar' => 'هاني محمد'];
        $my_parents->National_ID_Father = '1234567810';
        $my_parents->Passport_ID_Father = '1234567810';
        $my_parents->Phone_Father = '1234567810';
        $my_parents->Job_Father = ['en' => 'programmer', 'ar' => 'مبرمج'];
        $my_parents->Nationality_Father_id = Nationality::latest('created_at')->first();
        $my_parents->Blood_Type_Father_id = Type_Blood::latest('created_at')->first();
        $my_parents->Religion_Father_id = Religion::latest('created_at')->first();
        $my_parents->Address_Father ='القاهرة';
        $my_parents->Name_Mother = ['en' => 'Sosan', 'ar' => 'سوسن'];
        $my_parents->National_ID_Mother = '1234567810';
        $my_parents->Passport_ID_Mother = '1234567810';
        $my_parents->Phone_Mother = '1234567810';
        $my_parents->Job_Mother = ['en' => 'Teacher', 'ar' => 'معلمة'];
        $my_parents->Nationality_Mother_id = Nationality::latest('created_at')->first();
        $my_parents->Blood_Type_Mother_id =Type_Blood::latest('created_at')->first();
        $my_parents->Religion_Mother_id = Religion::latest('created_at')->first();
        $my_parents->Address_Mother ='القاهرة';
        $my_parents->save();

    }
}
