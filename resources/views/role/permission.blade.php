      @php
      $permissions = $permissions ?? [];
      
      @endphp
          <div class="col-md-12 col-12">
              <div class="card card-outline card-orange">
                  <div class="card-header bg-light">
                      <div class="card-title">
                          <h4><i class="fa fa-user-circle"></i> &nbsp;Assign Permission</h4>
                      </div>
                  </div>
                  @php
                  $permissionTypes = ['add', 'edit', 'view', 'delete','status' ,'approve', 'export', 'print'];
                  @endphp
                  {{-- Usage in your permission area --}}
                  <div class="card-body">
                      @php
                      $sidebarMenu = Helper::getSidebar() ?? [];

                   
                      @endphp
                      @if(!empty($sidebarMenu))



                      <form method='post' action='{{ url("role/permission/{$permissions['role_id']}") }}' id='permissionForm'>
                          @csrf
                          <input type='hidden' name='role_id' value="{{$permissions['role_id']}}" />


                          <table class="table table-bordered table-striped">
                              <thead>
                                  <tr>
                                      <th>Sr.No.</th>
                                      <th>Module</th>
                                      @foreach($permissionTypes as $type)
                                      <th>
                                          <input type="checkbox" class="check-all-type" data-type="{{ strtolower($type) }}" >&nbsp;{{ ucfirst($type) }}

                                      </th>
                                      @endforeach
                                  </tr>
                              </thead>
                              <tbody>
                                  @foreach($sidebarMenu as $index => $item)
                               
                                  <tr>
                                      <td>{{ $index+1 }}</td>
                                      <td>{{ $item['title'] }}</td>
                                      @foreach($permissionTypes as $type)
                                      <td>
                                          <input type="checkbox"
                                              name="permissions[]"
                                              value="{{ strtolower(str_replace(' ', '_', $item['title'])) . '.' . strtolower($type) }}" 
                                        
                                        
                                              {{ in_array(strtolower(str_replace(' ', '_', $item['title'])) . '.' . strtolower($type), $permissions['permissions']) ? 'checked' : '' }}  >


                                      </td>
                                      @endforeach
                                  </tr>
                                  @endforeach
                              </tbody>
                              <tfoot  >
                                  <tr>
                                      <td colspan="100%" class='text-center'><button type='submit'class=' role-footer-submit m-1 btn btn-xs bg-primary' style='display: none'>Submit </button></td>
                                  </tr>
                          </table>

                      </form>

                      @endif

                  </div>
              </div>
          </div>