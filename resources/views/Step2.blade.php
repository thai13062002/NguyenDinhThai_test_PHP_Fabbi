<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 2</title>
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
            <div class="step-box active">Step 2</div>
            <div class="step-box">Step 3</div>
            <div class="step-box">Review</div>
        </div>
        <form method="POST" action="{{ route('step3') }}">
            @csrf
            <div class="input-row">
                <label for="restaurant">Please Select a Restaurant</label>
                <select id="restaurant" name="restaurant" required>
                    <option value="">Select a Restaurant</option>
                    @foreach ($availableRestaurants as $restaurant)
                        <option value="{{ $restaurant }}">{{ $restaurant }}</option>
                    @endforeach
                </select>
            </div>
            <div class="button-row">
                <button type="button" class="previous-button" onclick="history.back()">Previous</button>
                <button type="submit" class="next-button">Next</button>
            </div>
        </form>
    </div>

</body>

</html>
