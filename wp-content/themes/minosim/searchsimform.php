<form id="form-tim-sim" role="search" method="get" class="search-sim-form">
  <div class="input-group">
    <input type="text" class="search-field form-control" placeholder="<?php echo esc_attr_x( 'Nhập số sim bạn cần tìm', 'placeholder' ) ?>" value="<?php echo get_search_sim_query() ?>" name="keyword" aria-describedby="search-form">
      <span class="input-group-append">
        <button type="submit" class="btn btn-primary" id="search-form"><?php echo esc_attr_x( 'Search', 'submit button' ) ?>
        </button>
      </span>
  </div>
  <div class="mt-2">
  - Tìm sim có số 8686 bạn hãy gõ 8686<br>
	- Tìm sim có đầu 098 đuôi 8686 hãy gõ 098*8686<br>
	- Tìm sim bắt đầu bằng 0987 đuôi bất kỳ, bạn hãy gõ: 0987*
  </div>
</form>