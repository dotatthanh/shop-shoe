<link href="{{ asset('assets/media/css/media.css') }}" rel="stylesheet" type="text/css" />

<div id="media" class="mb-2">
    <!-- Modal media -->
    <div class="modal animated bounceIn" id="mediaModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h4 class="modal-title">{{ __('Media') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <ul class="nav nav-tabs">
                        <li id="upload-media" class="nav-item"><a class="nav-link" data-toggle="tab" href="#upload-files">{{ __('Tải lên tập tin') }}</a></li>
                        <li id="media-list" class="nav-item active"><a class="nav-link active" data-toggle="tab" href="#media-library">{{ __('Thư viện') }}</a></li>
                    </ul>
                    <div class="tab-content">
                        <div id="upload-files" class="tab-pane container upload-files">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div id="upload" class="btn btn-default">
                                        <span><i class="fa fa-upload" aria-hidden="true"></i> {{ __('Chọn tập tin') }}<span>
                                    </div>
                                    <span id="status"></span>
                                    <div class="media-upload-load" style="display: none;"><img src="/images/loading-1.gif" width="100px"></div>
                                </div>
                            </div>
                        </div>

                        <div id="media-library" class="tab-pane active">
                            <div id="filter-media">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <select id="media_filter_date" class="form-control">
                                                <option value="all" selected="selected">{{ __('Tất cả') }}</option>
                                                <?php $today=date( 'Y-m-1'); while (date( 'Y', strtotime($today))>= 2019) {?>
                                                    <option value="<?=$today?>">
                                                        <?php echo date( 'F Y', strtotime($today));?>
                                                    </option>
                                                <?php $month_plus=date( 'Y-m-d', strtotime($today . " -1 month")); $today=$month_plus; } ?>
                                            </select>
                                        </div>
                                    </div>
                                   
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="key-search-file" placeholder="{{ __('Từ khóa cần tìm') }}">
                                        </div>
                                    </div>

                                    <div class="col-sm-4">
                                        <button class="btn btn-primary" id="media_sub_search" type="button">{{ __('Tìm kiếm') }}</button>
                                    </div>
                                </div>
                            </div>

                            <div id="list-media" class="list-media">
                                <ul class="data"></ul>
                                <div class="loadding-media"></div>
                                <div class="text-center">
                                    <button type="button" class="btn btn-light" id="media_load_more">{{ __('Tải thêm ...') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" id="delete-media" class="btn btn-danger" disabled='disabled'>{{ __('Xóa') }}</button>
                    <button type="button" id="insert-into-post" class="btn btn-primary" disabled='disabled'>{{ __('Áp dụng') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- modal article -->
    <div class="modal animated bounceIn" id="articleModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">{{ __('Bài viết mẫu') }}</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div id="list-article" class="list-media"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="use-article-sample" class="btn btn-primary" disabled='disabled'>{{ __('Sử dụng mẫu') }}</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('assets/media/js/fileuploadmulti.js') }}?v=1.0.1"></script>
<script src="{{ asset('assets/media/js/media.js') }}?v=1.0.1"></script>
