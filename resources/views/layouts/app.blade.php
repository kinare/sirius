<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        // rename myToken as you like
        window.myToken =  <?php echo json_encode([
            'csrfToken' => csrf_token(),
        ]); ?>
    </script>

    <title>{{ config('app.name', 'Bantam') }}</title>
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    {{--testing--}}

    <!-- for the inspinia theme -->
    <link href="{{ asset('font-awesome/css/font-awesome.css') }}"  rel="stylesheet">
    <link href="{{ asset('css/animate.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">


    <!--- for text spinners-->
    <link href="{{ asset('css/plugins/textSpinners/spinners.css') }}" rel="stylesheet">

<!--- Added when adding calender in leave planner view
-->
    <link href="{{ asset('css/plugins/iCheck/custom.css')}}" rel="stylesheet">
    <link href="{{ asset('css/plugins/fullcalendar/fullcalendar.css')}}" rel="stylesheet">
    <link href="{{ asset('css/plugins/fullcalendar/fullcalendar.print.css')}}" rel='stylesheet' media='print'>
    <!--


    End of leave planner  imports -->

    <!--  Ladda css added by Mayaka. This is for the button spinners -->
        <!-- Ladda style -->
        <link href="{{ asset('css/plugins/ladda/ladda-themeless.min.css')}}" rel="stylesheet">

    <!-- End of ladda -->
    <link href="{{ asset('css/plugins/datapicker/datepicker3.css')}}" rel="stylesheet">

    <style>
        [v-cloak]{
            display: none;
        }
        .fullscreenDiv {
            background-color: #f3f3f4;
            width: 100%;
            height: auto;
            bottom: 0px;
            top: 0px;
            left: 0;
            position: absolute;
        }
        .center {
            position: absolute;
            width: 100px;
            height: 50px;
            top: 50%;
            left: 50%;
            margin-top: -25px;
            margin-left: -50px;
        }
    </style>

</head>
<body class="gray-bg" style="background-color: #1E824C">
<div id="app">

    <main  class="py-4  animated fadeIn" v-cloak>
        <div v-show="pageLoading" class='fullscreenDiv'>
            <div class="center">
                <div class="sk-spinner sk-spinner-pulse"></div>
            </div>
        </div>
        <div v-show="!pageLoading">
            @yield('content')
        </div>
    </main>
</div>
<script src="js/jquery-3.1.1.min.js"></script>
<!-- Data picker -->
{{--<script src="{{ asset('js/plugins/datapicker/bootstrap-datepicker.js')}}"></script>--}}
<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
<script src="{{ asset('js/plugins/metisMenu/jquery.metisMenu.js') }}"></script>
<script src="{{ asset('js/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('js/inspinia.js') }}"></script>
<script src="{{ asset('js/plugins/pace/pace.min.js') }}"></script>
<script src="{{ asset('js/plugins/dataTables/datatables.min.js') }}"></script>

<!-- Ladda  :: added  by @mayaka-->
<script src="{{asset("js/plugins/ladda/spin.min.js")}}"></script>
<script src="{{asset("js/plugins/ladda/ladda.min.js")}}"></script>
<script src="{{asset("js/plugins/ladda/ladda.jquery.min.js")}}"></script>
<!--  End of ladda -->
</body>
</html>
