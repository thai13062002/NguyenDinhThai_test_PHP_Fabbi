<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Step 3</title>
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
            overflow-y: auto;
            max-height: 400px;
        }

        select,
        input[type="number"] {
            width: calc(100% - 20px);
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

        .add-button {
            padding: 10px 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .add-button:hover {
            background-color: #218838;
        }

        .alert-danger {
            color: red;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="step-row">
            <div class="step-box">Step 1</div>
            <div class="step-box">Step 2</div>
            <div class="step-box active">Step 3</div>
            <div class="step-box">Review</div>
        </div>
        <h4>Please Select a Dish and enter the number of servings</h4>


        <form method="POST" action="{{ route('step4') }}">
            @csrf

            <div id="dishes-container">
                <div class="input-row" data-index="0">
                    <label for="dish1">Dish 1</label>
                    <select name="dishes[0][dish]" class="dish-select" required>
                        <option value="">Select a Dish</option>
                        @foreach ($dishes as $dish)
                            <option value="{{ $dish['name'] }}">{{ $dish['name'] }}</option>
                        @endforeach
                    </select>
                    <input type="number" name="dishes[0][quantity]" value="1" min="1" required>
                </div>
            </div>

            <button type="button" class="add-button" id="add-dish">Add Dish</button>

            <div class="button-row">
                <button type="button" class="previous-button" onclick="history.back()">Previous</button>
                <button type="submit" id="next-button" class="next-button">Next</button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var container = document.getElementById('dishes-container');
            var numPeople = parseInt('{{ session('num_people') }}');
            var selectedDishes = {!! json_encode(session('selected_dishes')) !!};

            document.getElementById('add-dish').addEventListener('click', function() {
                var index = container.querySelectorAll('.input-row').length;

                var div = document.createElement('div');
                div.className = 'input-row';
                div.setAttribute('data-index', index);

                var label = document.createElement('label');
                label.textContent = 'Dish ' + (index + 1);
                div.appendChild(label);

                var select = document.createElement('select');
                select.name = 'dishes[' + index + '][dish]';
                select.className = 'dish-select';
                select.required = true;
                var defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select a Dish';
                select.appendChild(defaultOption);
                @foreach ($dishes as $dish)
                    var option = document.createElement('option');
                    option.value = '{{ $dish['name'] }}';
                    option.textContent = '{{ $dish['name'] }}';
                    select.appendChild(option);
                @endforeach
                div.appendChild(select);

                var input = document.createElement('input');
                input.type = 'number';
                input.name = 'dishes[' + index + '][quantity]';
                input.value = 1;
                input.min = 1;
                input.required = true;
                div.appendChild(input);

                container.appendChild(div);

                if (container.querySelectorAll('.input-row').length >= numPeople) {
                    document.getElementById('add-dish').style.display = 'none';
                }

                select.addEventListener('change', function(event) {
                    var selectedValue = event.target.value;
                    var selects = container.querySelectorAll('.dish-select');
                    var selectedQuantities = [];

                    selects.forEach(function(sel) {
                        if (sel !== select) {
                            if (sel.value === selectedValue) {
                                var prevInput = sel.nextElementSibling;
                                if (prevInput && prevInput.nodeName === 'INPUT') {
                                    prevInput.value = parseInt(prevInput.value) + 1 || 1;
                                }
                                container.removeChild(div);
                                return;
                            }
                        }
                    });
                });
            });

            selectedDishes.forEach(function(dish, index) {
                var div = document.createElement('div');
                div.className = 'input-row';
                div.setAttribute('data-index', index);

                var label = document.createElement('label');
                label.textContent = 'Dish ' + (index + 1);
                div.appendChild(label);

                var select = document.createElement('select');
                select.name = 'dishes[' + index + '][dish]';
                select.className = 'dish-select';
                select.required = true;
                var defaultOption = document.createElement('option');
                defaultOption.value = '';
                defaultOption.textContent = 'Select a Dish';
                select.appendChild(defaultOption);
                @foreach ($dishes as $dish)
                    var option = document.createElement('option');
                    option.value = '{{ $dish['name'] }}';
                    option.textContent = '{{ $dish['name'] }}';
                    if ('{{ $dish['name'] }}' === dish.dish_id) {
                        option.selected = true;
                    }
                    select.appendChild(option);
                @endforeach
                div.appendChild(select);

                var input = document.createElement('input');
                input.type = 'number';
                input.name = 'dishes[' + index + '][quantity]';
                input.value = dish.quantity;
                input.min = 1;
                input.required = true;
                div.appendChild(input);

                container.appendChild(div);
            });

        });

        var numPeople = parseInt('{{ session('num_people') }}');

        function submitForm() {
            document.getElementById('step-form').submit();
        }

        document.getElementById('next-button').addEventListener('click', function(event) {
            event.preventDefault();

            var totalQuantity = 0;
            var quantityInputs = document.querySelectorAll('input[name^="dishes["]');
            quantityInputs.forEach(function(input) {
                totalQuantity += parseInt(input.value) || 0;
            });
            console.log(totalQuantity);

            if (totalQuantity < numPeople) {
                var errorMessageDiv = document.createElement('div');
                errorMessageDiv.className = 'alert-danger';
                errorMessageDiv.textContent =
                    'Total quantity of dishes must be equal or greater than the number of people.';

                document.querySelector('h4').insertAdjacentElement('afterend', errorMessageDiv);

                setTimeout(function() {
                    errorMessageDiv.remove();
                }, 3000);
            } else {
                submitForm();
            }
        });
    </script>

</body>

</html>
