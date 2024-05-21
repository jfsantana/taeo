
    <div class="form-group">
      <label for="exampleInputFile">File input</label>
      <div class="input-group">
         <div class="custom-file">
         <label class="custom-file-label" for="exampleInputFile">Buscar Archivo</label>
         <input type="file"  accept=".xlsx" class="custom-file-input" id="exampleInputFile">

        </div>
        <div class="input-group-append">
          <span class="input-group-text">Upload</span>
        </div>
      </div>
    </div>

<div class="col-md-12">
  <div class="card card-default">
    <div class="card-header">
      <h3 class="card-title">Dropzone.js <small><em>jQuery File Upload</em> like look</small></h3>
    </div>
    <div class="card-body">
      <div id="actions" class="row">
        <div class="col-lg-6">
          <div class="btn-group w-100">
            <span class="btn btn-success col fileinput-button dz-clickable">
              <i class="fas fa-plus"></i>
              <span>Add files</span>
            </span>
            <button type="submit" class="btn btn-primary col start">
                <i class="fas fa-upload"></i>
                  <span>Start upload</span>
            </button>
            <button type="reset" class="btn btn-warning col cancel">
                <i class="fas fa-times-circle"></i>
                  <span>Cancel upload</span>
            </button>
          </div>
        </div>
      <div class="col-lg-6 d-flex align-items-center">
    <div class="fileupload-process w-100">
  <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
<div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress=""></div>
</div>
</div>
</div>
</div>
<div class="table table-striped files" id="previews">

</div>
</div>

<div class="card-footer">
Visit <a href="https://www.dropzonejs.com">dropzone.js documentation</a> for more examples and information about the plugin.
</div>
</div>

</div>

