@if (session()->has('message'))
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <ul>
          <li>{{ session('message') }}</li>
        </ul>
    </div>
@endif
