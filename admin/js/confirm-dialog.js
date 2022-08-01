
  function confirmDialogBox(message, handler){
    $(`<div>
					<!--Modal form for delete confirmation -->
					<div id="confirm-delete" class="modal fade" data-bs-backdrop="static" tabindex="-1">
						<div class="modal-dialog modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header bg-muted ">
									<h5 class="modal-title fw-bold lead w-90"> <i class="bi-exclamation-triangle-fill text-warning"></i> Confirm Post Delete !</h5>
									<button type="button" class="btn-close border w-10" data-bs-dismiss="modal"></button>
								</div>
								<div class="modal-body">
									<p class="lead">Are you sure you want to delete this post? </p>
									<p class="text-secondary"> If you choose 'Delete', all related comments and replies will also be deleted.</p>
								</div>
								<div class="modal-footer justify-content-around">
									<button type="button" class="btn btn-success" data-bs-dismiss="modal">Cancel</button>
									<button type="button" class="btn btn-danger btn-delete">Delete</button>
								</div>
							</div>
						</div>
					</div>
				</div>`).appendTo('body');

        //Triger the dialog box
        $('#confirm-dialog').modal({
          backdrop: 'static',
          keyboard: false
        });

        //Remove dialog once closed
        $('#confirm-dialog').on('hidden.bs.modal',function(){
          $('#confirm-dialog').remove();
        });

        //Pass true callback function
        $('.btn-delete').click(function(){
          handler(true);
          $('#confirm-dialog').modal('hide');
        });

        //Pass false callback function
        $('.btn-cancel').click(function(){
          handler(false);
          $('#confirm-dialog').modal('hide');
        });
  }
