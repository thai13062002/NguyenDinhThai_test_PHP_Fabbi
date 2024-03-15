<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StepController extends Controller
{
    public function step1()
    {

          return view('step1');
    }

    public function step2(Request $request)
    {
        $jsonData = file_get_contents(base_path('storage/app/public/dishes.json'));
        $data = json_decode($jsonData, true);

        $selectedMeal = $request->input('meal_category');
        $availableRestaurants = [];
        foreach ($data['dishes'] as $dish) {
            if (in_array($selectedMeal, $dish['availableMeals'])) {
                $availableRestaurants[$dish['restaurant']] = $dish['restaurant'];
            }
        }
        $request->session()->put('meal_category', $request->input('meal_category'));
        $request->session()->put('num_people', $request->input('num_people'));
        return view('step2', ['availableRestaurants' => $availableRestaurants]);
    }
    public function step3(Request $request)
    {
        $mealCategory = $request->session()->get('meal_category');
        $numPeople = $request->session()->get('num_people');
        $restaurant = $request->input('restaurant');

        $jsonData = file_get_contents(base_path('storage/app/public/dishes.json'));
        $data = json_decode($jsonData, true);

        $dishes = [];
        foreach ($data['dishes'] as $dish) {
            if ($dish['restaurant'] == $restaurant && in_array($mealCategory, $dish['availableMeals'])) {
                $dishes[] = $dish;
            }
        }

        $request->session()->put('restaurant', $request->input('restaurant'));

        return view('step3', compact('dishes', 'numPeople'));
    }

    public function step4(Request $request)
    {

        $mealCategory = $request->session()->get('meal_category');
        $numPeople = $request->session()->get('num_people');
        $restaurant = $request->session()->get('restaurant');

        $dishes = $request->input('dishes', []);

        $request->session()->put('dishes', $request->input('dishes'));

        return view('step4', compact('mealCategory', 'numPeople', 'restaurant','dishes' ));
    }

    public function submit(Request $request)
    {
        $mealCategory = $request->session()->get('meal_category');
        $numPeople = $request->session()->get('numPeople');
        $restaurant = $request->session()->get('restaurant');
        $dishes =  $request->session()->get('dishes');

        $data = [
            'meal' => $mealCategory,
            'numPeople' => $numPeople,
            'restaurant' => $restaurant,
            'dishes' => $dishes
        ];

        $jsonData = json_encode($data);

        $filePath = base_path('storage/app/public/submit.json');

        file_put_contents($filePath, $jsonData);

        $request->session()->flush();

        return redirect()->route('step1')->with('success', 'Data submitted successfully.');

    }


}
