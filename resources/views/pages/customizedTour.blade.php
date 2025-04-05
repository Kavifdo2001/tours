@extends('layouts.front')
@section('content')

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <style>
        .customize-tour-header {
            background-color: #f8f9fa;
            padding: 30px 0;
            text-align: center;
        }

        .customize-tour-header h1 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .customize-form-container {
            background-color: #ffffff;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: 20px auto;
            max-width: 800px;
        }

        .customize-form-container h2 {
            font-size: 28px;
            margin-bottom: 15px;
            font-weight: bold;
            color: #343a40;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: bold;
            color: #333;
        }

        .form-select, .form-control {
            border: 2px solid #4d4c4c;
            border-radius: 5px;
        }

        .submit-btn {
            background-color: #004669;
            color: #fff;
            font-weight: bold;
            padding: 10px 20px;
            border: none;
            transition: background-color 0.3s ease;
        }

        .submit-btn:hover {
            background-color: #00263a;
        }

        .route-button {
            display: flex;
            align-items: center;
            background-color: #0b3e7c; /* Bootstrap primary color */
            color: white;
            padding: 5px 10px;
            margin: 5px 0;
            border-radius: 5px;
        }

        .remove-route {
            cursor: pointer;
            color: #fc4e5d; /* Bootstrap danger color */
            margin-left: 8px;
            font-weight: bold;
        }

        .d-flex {
            display: flex;
        }

        .flex-wrap {
            flex-wrap: wrap;
        }
    </style>

    <div class="customize-tour-header">
        <h1>Customize Your Tour Package</h1>
        <p>Personalize your experience to make the most of your trip.</p>
    </div>


    <div class="container customize-form-container">
        <h2>Customization {{$package->category->category_name}} Tour </h2>


        <form action="{{ route('storeCustomizedTour') }}" method="POST">
            @csrf

            <!-- Destination Selection -->
            <div class="form-group">
                <label for="destination" class="form-label">Select Your Routes:</label>
                <select id="destination" class="form-select">
                    <option value="">Select a Route</option>
                    @foreach($routes as $route)
                        <option value="{{ $route->id }}">{{ $route->name }}</option>
                    @endforeach
                </select>
                <div id="selected-routes" class="mt-2 d-flex flex-wrap"></div>
            </div>

            <input type="hidden" name="destination" id="destination-input" value="">

            <input type="hidden" name="category_id" value="{{$package->category->id}}">


            <!-- Number of Days -->
            <div class="form-group">
                <label for="days" class="form-label">Number of Days:</label>
                <input type="number" class="form-control" id="days" name="days" min="0" value="0" required   style="width: 150px">
            </div>


            <!-- Hotel Preferences -->
{{--            <div class="form-group">--}}
{{--                <label for="hotel" class="form-label">Hotel Preference:</label><br>--}}
{{--                @foreach([1, 3, 5, 7] as $star)--}}
{{--                    <div class="form-check form-check-inline">--}}
{{--                        <input class="form-check-input" type="checkbox" name="hotel[]" value="{{ $star }}-star" id="{{ $star }}-star">--}}
{{--                        <label class="form-check-label" for="{{ $star }}-star">{{ $star }} Star</label>--}}
{{--                    </div>--}}
{{--                @endforeach--}}
{{--            </div>--}}



            <!-- Inclusions -->
            <div class="form-group">
                <label class="form-label">Select Inclusions:</label><br>
                @foreach($categoryInclusions as $inclusion)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="checkbox" name="inclusions[]" value="{{ $inclusion->id }}" id="inclusion-{{ $inclusion->id }}">
                        <label class="form-check-label" for="inclusion-{{ $inclusion->id }}">{{ $inclusion->name }}</label>
                    </div>
                @endforeach
            </div>

            <!-- Air Tickets -->
            <div class="form-group">
                <label class="form-label">Select Air Tickets:</label><br>
                @foreach($airTickets as $airTicket)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="air_ticket" value="{{ $airTicket->id }}" id="air-ticket-{{ $airTicket->id }}">
                        <label class="form-check-label" for="air-ticket-{{ $airTicket->id }}">{{ $airTicket->name }}</label>
                    </div>
                @endforeach
            </div>

            <div class="form-group">
                <label class="form-label">Select Departure:</label><br>
                @foreach($departures as $departure)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="departure" value="{{ $departure->id }}" id="departure-{{ $departure->id }}">
                        <label class="form-check-label" for="departure-{{ $departure->id }}">
                            {{ $departure->name }}
                        </label>
                    </div>
                @endforeach
            </div>



            <!-- Additional Requests -->
            <div class="form-group">
                <label for="requests" class="form-label">Additional Requests:</label>
                <textarea id="requests" name="requests" class="form-control" rows="3" placeholder="Any special requests or requirements?"></textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn submit-btn">Submit Customization</button>
        </form>
    </div>

    <script>
        const daysInput = document.getElementById('days');

        daysInput.addEventListener('input', function () {
            if (this.value < 0) {
                this.value = 0; // Reset to 0 if negative value is entered
            }
        });
    </script>

    <script>
        const destinationSelect = document.getElementById('destination');
        const selectedRoutesDiv = document.getElementById('selected-routes');
        const destinationInput = document.getElementById('destination-input');

        // Keep track of selected route IDs
        let selectedRouteIds = [];

        // Function to update the display of selected routes and the hidden input
        function updateSelectedRoutes() {
            selectedRoutesDiv.innerHTML = ''; // Clear previous selections
            selectedRouteIds.forEach(id => {
                const routeItem = document.createElement('div');
                routeItem.classList.add('route-button', 'me-2', 'd-flex', 'align-items-center');
                routeItem.innerHTML = `
            ${destinationSelect.querySelector(`option[value="${id}"]`).text}
            <span class="remove-route" data-value="${id}">&times;</span>
        `;
                selectedRoutesDiv.appendChild(routeItem);
            });

            // Update the hidden input with the selected route IDs
            destinationInput.value = selectedRouteIds.join(',');
        }

        // Event listener for changes in the select input
        destinationSelect.addEventListener('change', function () {
            const selectedValue = destinationSelect.value;

            // Check if the value is not empty and not already selected
            if (selectedValue && !selectedRouteIds.includes(selectedValue)) {
                selectedRouteIds.push(selectedValue); // Add selected value to the array
            }

            // Update the display of selected routes
            updateSelectedRoutes();

            // Clear the select input (optional)
            destinationSelect.value = '';
        });

        // Event delegation to handle remove buttons
        selectedRoutesDiv.addEventListener('click', function (event) {
            if (event.target.classList.contains('remove-route')) {
                const valueToRemove = event.target.getAttribute('data-value');

                // Remove the selected value from the array
                selectedRouteIds = selectedRouteIds.filter(id => id !== valueToRemove);

                // Update the display of selected routes
                updateSelectedRoutes();
            }
        });

    </script>

    <script>
        // Display success message
        @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success',
            text: '{{ session('success') }}',
            showConfirmButton: false,
            timer: 3000
        });
        @endif

        // Display error messages
        @if ($errors->any())
        let errorMessages = '';
        @foreach ($errors->all() as $error)
            errorMessages += '<p>{{ $error }}</p>';
        @endforeach
        Swal.fire({
            icon: 'error',
            title: 'Oops...',
            html: errorMessages,
            showCloseButton: true
        });
        @endif
    </script>


@endsection
