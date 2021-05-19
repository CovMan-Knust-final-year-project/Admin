<div class="modal fade" id="accountModal" role="dialog" aria-labelledby="accountModalLabel" aria-hidden="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">PERSONAL INFO</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" id="personal_info">
                <div class="card-body">
                    <div class="row row-space">
                        <div class="col-4">
                            <div class="form-group">

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">
                                <div class="form-file">
                                    <input type="file" class="inputfile" onchange="readURL(this);" name="your_picture" id="your_picture">
                                    <label for="your_picture">
                                        <figure>
                                            <img class="your_picture_image rounded-circle z-depth-2" alt="100x100" src="assets/img/new_logo.png" data-holder-rendered="true" width="100%">
                                        </figure>
                                        <span class="file-button bg bg-dark text-white text-center" style="padding:5px; border-radius:10px">choose picture</span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="form-group">

                            </div>
                        </div>
                    </div>

                    <div class="row row-space mt-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="input-select" class="control-label">First name</label>
                                <input class="form-control prc" type="text" name="f_name" id="f_name">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="address-number" class="control-label">Last_name</label>
                                <input class="form-control prc" type="text" name="l_name" id="l_name">
                            </div>
                        </div>
                    </div>

                    <div class="row row-space mt-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="input-select" class="control-label">Date of birth</label>
                                <input class="form-control prc" type="date" name="dob" id="dob">
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="form-group">
                                <label for="address-number" class="control-label">Phone number</label>
                                <input class="form-control prc" type="text" name="phone_number" id="phone_number" maxlength="14" onkeypress="return numberOnly(event)">
                            </div>
                        </div>
                    </div>

                    <div class="row row-space mt-3">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-select" class="control-label">Level</label>
                                <input class="form-control prc" type="text" name="level" id="level" onkeypress="return numberOnly(event)">
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