<div class="modal fade" id="addMountPointModal" role="dialog" aria-labelledby="addMountPointModalLabel" aria-hidden="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMountPointModalLabel">ADD MOUNT POINT</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" id="add_mount_point_form">
                <div class="card-body">
                    <div class="row row-space">
                        <div class="col-4">
                            <div class="form-group">

                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-select" class="control-label">Venue Name</label>
                                <input class="form-control prc" type="text" name="venue_name" id="venue_name">
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">

                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>