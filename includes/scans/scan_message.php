<div class="modal fade" id="sendMessageModal" role="dialog" aria-labelledby="sendMessageModalLabel" aria-hidden="true"
    data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="sendMessageModalLabel">SEND MESSAGE TO USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form method="POST" enctype="multipart/form-data" id="send_message_form">
                <div class="card-body">
                    <div class="row row-space">
                        <div class="col-4">
                            <div class="form-group">

                            </div>
                        </div>
                        
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-select" class="control-label">Topic</label>
                                <input class="form-control prc" type="text" name="topic" id="topic" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label for="input-select" class="control-label">Message</label>
                                <textarea class="form-control prc" name="message" id="message"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="cancel">Cancel</button>
                    <button type="submit" name="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>
        </div>
    </div>
</div>