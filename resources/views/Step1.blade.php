<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 1</title>
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
        }

        .input-row label {
            display: block;
            margin-bottom: 5px;
        }

        .button-row {
            text-align: right;
        }
        .alert-success{
            color: green;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="step-row">
            <div class="step-box active">Step 1</div>
            <div class="step-box">Step 2</div>
            <div class="step-box">Step 3</div>
            <div class="step-box">Review</div>
        </div>
        @if (session('success'))
            <div id="success-message" class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('step2') }}">
            @csrf
            <div class="input-row">
                <label for="meal_category">Please Select a meal</label>
                <select id="meal_category" name="meal_category" required>
                    <option value="breakfast">Breakfast</option>
                    <option value="lunch">Lunch</option>
                    <option value="dinner">Dinner</option>
                </select>
            </div>
            <div class="input-row">
                <label for="num_people">Number of People:</label>
                <input type="number" id="num_people" name="num_people" min="1" max="10" value="1"
                    required>
            </div>
            <div class="button-row">
                <button type="submit">Next</button>
            </div>
        </form>
    </div>
    <script>
        setTimeout(function() {
            var successMessage = document.getElementById('success-message');
            if (successMessage) {
                successMessage.style.display = 'none';
            }
        }, 3000);
    </script>

</body>

</html>
