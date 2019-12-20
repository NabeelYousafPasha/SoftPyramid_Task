@extends('dashboard.layout.app')
@section('stylesheets')
  {{-- iCheck --}}
  <link href="{{ asset('backend-assets/css/plugins/iCheck/custom.css') }}" rel="stylesheet">
  <link href="{{ asset('backend-assets/css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css') }}" rel="stylesheet">
  <link href="{{ asset('backend-assets/css/plugins/dataTables/datatables.min.css') }}" rel="stylesheet">
@endsection
@section('content')
  <div class="row wrapper border-bottom white-bg page-heading">
      <div class="col-lg-10">
          <h2>{{ $page_title }}</h2>
          <ol class="breadcrumb">
              <li>
                  <a href="{{ '/' }}">Home</a>
              </li>
              <li class="active">
                  <strong>{{ $page_title }}</strong>
              </li>
          </ol>
      </div>
        <div class="col-lg-2" style="float: right;">
        <h2></h2>
        </div>
    </div>
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
              <div class="ibox float-e-margins">
                  <div class="ibox-title">
                      <h5>List of All {{ $page_title }}</h5>
                      <div class="ibox-tools">
                          <button id="permission_role_form_submit_btn" type="button" class="btn-primary btn-xs">
                              Save Changes
                          </button>
                          <a class="collapse-link">
                              <i class="fa fa-chevron-up"></i>
                          </a>
                      </div>
                  </div>
                  <div class="ibox-content">
                      <div class="table-responsive">
                        <form
                            action="{{ route('permission_role') }}"
                            method="POST"
                            id="permission_role_form"
                            name="permission_role_form"
                            >
                          @csrf
                          <table class="table table-striped table-bordered table-hover">
                            <thead>
                              <tr>
                                <th>Permissions</th>
                                @foreach($roles as $role)
                                <th>{!! $role->name !!}</th>
                                @endforeach
                              </tr>
                            </thead>
                            <tbody>
                              @foreach($permissions as $permission)
                                <tr>
                                  <td>
                                      {{ $permission->name }}
                                  </td>
                                  @foreach($roles as $role)
                                  <th>
                                      <input
                                          class="i-checks checkbox"
                                          type="checkbox"
                                          name="permission_role[{!!$permission->id!!}][{!!$role->id!!}]"
                                          value="1"
                                          {!! (in_array($permission->id.'-'.$role->id, $permission_role)) ? 'checked' : '' !!}
                                        >
                                  </th>
                                  @endforeach
                                </tr>
                              @endforeach
                            </tbody>
                          </table>
                        </form>
                      </div>
                  </div>
              </div>
          </div>
        </div>
    </div>
@endsection
@section('scripts')
  <script src="{{ asset('backend-assets/js/plugins/dataTables/datatables.min.js') }}"></script>
  <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                pageLength: 25,
                responsive: true,
            });

        });
    </script>
    <!-- iCheck -->
    <script src="{{ asset('backend-assets/js/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
        $(document).ready(function(){
            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green',
            });
        });
    </script>
    <script type="text/javascript">
      $('#permission_role_form_submit_btn').click(function(){
        $('#permission_role_form').submit();
      });
    </script>
@endsection
