<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            width: 400px;
            text-align: center;
        }

        select,
        input[type="number"] {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }

        button[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }

        .step-box {
            display: inline-block;
            width: 100px;
            height: 50px;
            line-height: 50px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-right: 10px;
            cursor: pointer;
        }

        .active {
            background-color: #007bff;
            color: #fff;
        }

        .step-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .input-row {
            margin-bottom: 10px;
            text-align: left;
            /* Căn lề trái */
        }

        .input-row label {
            display: block;
            margin-bottom: 5px;
            /* Khoảng cách giữa label và input */
        }

        .button-row {
            display: flex;
            justify-content: space-between;
        }

        .previous-button,
        .next-button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .previous-button:hover,
        .next-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="step-row">
            <div class="step-box">Step 1</div>
            <div class="step-box ">Step 2</div>
            <div class="step-box">Step 3</div>
            <div class="step-box active">Review</div>
        </div>
        <form method="POST" action="{{ route('submit') }}">
            @csrf
            <div class="input-row">
                <label for="restaurant">Meal: {{$mealCategory}}</label>
                <label for="restaurant">No of peaple: {{$numPeople}}</label>
                <label for="restaurant">Restaurant: {{$restaurant}}</label>
                <label for="restaurant">Dishes:</label>
                <ul>
                    @foreach($dishes as $dish)
                    <li>{{ $dish['dish'] }} - Quantity: {{ $dish['quantity'] }}</li>
                    @endforeach
                </ul>
            </div>
            <div class="button-row">
                <button type="button" class="previous-button" onclick="history.back()">Previous</button>
                <button type="submit" class="next-button">Submit</button>
            </div>
        </form>
    </div>

</body>

</html>
