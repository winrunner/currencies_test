<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Currencies</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 my-3 text-center"><h3>{{ $title }}</h3></div>
            <div class="col-md-6 my-3 text-center"><h3>{{ $currentDate }}</h3></div>
            <div class="col-md-12">
                @if($currencies)
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>Rate</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($currencies as $currency)
                        <tr>
                            <td>{{ $currency['name'] }}</td>
                            <td>{{ $currency['rate'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row mt-3 mb-5">
                    <div class="col-md-6 text-center">
                    @if($datePrevTitle != '')
                        <a href="{{ $datePrevLink }}" class="btn btn-outline-primary">{{ $datePrevTitle }}</a>
                    @endif
                    </div>
                    <div class="col-md-6 text-center">
                    @if($dateNextTitle != '')
                        <a href="{{ $dateNextLink }}" class="btn btn-outline-primary">{{ $dateNextTitle }}</a>
                    @endif
                    </div>
                </div>
                @else
                <p>Not found</p>
                <a href="/currencies" class="btn btn-outline-primary">Go to currencies</a>
                @endif
            </div>
        </div>
    </div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>