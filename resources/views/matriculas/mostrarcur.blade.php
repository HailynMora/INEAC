<!--tabla para ver los valores-->
<link href="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/css/bootstrap4-toggle.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/gh/gitbrent/bootstrap4-toggle@3.6.1/js/bootstrap4-toggle.min.js"></script>
<table class="table">
              <thead class="table-warning">
              <tr>
               
                <th scope="col">Codigo</th>
                <th scope="col">Descripción</th>
                <th scope="col">Estado</th>
                <th scope="col">Acción</th>
              </tr>
            </thead>
            <tbody>
                <tr>
                  <td>{{ $post[0]->codigo }}</td>
                  <td>{{ $post[0]->programa }}</td>
                  <td>{{ $post[0]->estado }}</td>
                <td>
                <input type="checkbox" checked data-toggle="toggle" data-style="ios"  id="cur" name="cur" value="{{$post[0]->id}}">
                </td>
                </tr>
            </tbody>
          </table>

<style>
  .toggle.ios, .toggle-on.ios, .toggle-off.ios { border-radius: 30rem; }
  .toggle.ios .toggle-handle { border-radius: 30rem; }
</style>


        <!--end tabla-->
