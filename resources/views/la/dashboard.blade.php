@extends('la.layouts.app')

@section('htmlheader_title') Dashboard @endsection
@section('contentheader_title') Dashboard @endsection
@section('contentheader_description') Organisation Overview @endsection

@section('main-content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->

        <!-- Main row -->
        <div class="row">
            <!-- Left col -->

            <!-- right col (We are only adding the ID to make the widgets sortable)-->

            <!-- Map box -->
            <div class="box box-solid bg-light-blue-gradient">
                <div class="box-header">


                    <!-- solid sales graph -->

                    <!-- Calendar -->
                    <div class="box box-solid bg-green-gradient">
                        <div class="box-header">
                            <i class="fa fa-calendar"></i>
                            <h3 class="box-title">Calendar</h3>
                            <!-- tools box -->
                            <div class="pull-right box-tools">
                                <!-- button with a dropdown -->
                                <div class="btn-group">
                                    <button class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown"><i
                                                class="fa fa-bars"></i></button>
                                    <ul class="dropdown-menu pull-right" role="menu">
                                        <li><a href="#">Add new event</a></li>
                                        <li><a href="#">Clear events</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#">View calendar</a></li>
                                    </ul>
                                </div>
                                <button class="btn btn-success btn-sm" data-widget="collapse"><i
                                            class="fa fa-minus"></i></button>
                                <button class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                                </button>
                            </div><!-- /. tools -->
                        </div><!-- /.box-header -->
                        <div class="box-body no-padding">
                            <!--The calendar -->
                            <div id="calendar" style="width: 100%"></div>
                        </div><!-- /.box-body -->
                        <div class="box-footer text-black">
                            <div class="row">


                            </div><!-- /.row -->
                        </div>
                    </div><!-- /.box -->


                </div><!-- /.row (main row) -->
            </div>
        </div>
    </section><!-- /.content -->
@endsection

@push('styles')
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ asset('la-assets/plugins/morris/morris.css') }}">
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('la-assets/plugins/datepicker/datepicker3.css') }}">
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ asset('la-assets/plugins/daterangepicker/daterangepicker-bs3.css') }}">
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
@endpush


@push('scripts')
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Morris.js charts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="{{ asset('la-assets/plugins/morris/morris.min.js') }}"></script>
    <!-- Sparkline -->
    <script src="{{ asset('la-assets/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
    <!-- jvectormap -->
    <script src="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
    <script src="{{ asset('la-assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
    <!-- jQuery Knob Chart -->
    <script src="{{ asset('la-assets/plugins/knob/jquery.knob.js') }}"></script>
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
    <script src="{{ asset('la-assets/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- datepicker -->
    <script src="{{ asset('la-assets/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
    <!-- Bootstrap WYSIHTML5 -->
    <script src="{{ asset('la-assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ asset('la-assets/plugins/fastclick/fastclick.js') }}"></script>
    <!-- dashboard -->
    <script src="{{ asset('la-assets/js/pages/dashboard.js') }}"></script>
@endpush
