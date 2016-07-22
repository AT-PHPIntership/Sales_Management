<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
  <form class="form-group" action="{{ route('search.user') }}" method="GET">
  <div class="input-group">
    <input type="text" name="q" class="form-control" placeholder="@lang('common.input_search_placeholder')">
    <span class="input-group-btn">
      <button class="btn btn-default" type="submit" title="@lang('common.btn_search_title')"><i class="fa fa-search"></i></button>
    </span>
  </div>
</form>
</div>
