<div>
  <div id="confirm-dialog" class="modal fade" data-bs-backdrop="static" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-muted ">
          <h5 class="modal-title fw-bold lead w-90"> <i class="bi-exclamation-triangle-fill text-warning"></i> <?php echo $dialog_title ?></h5>
          <button type="button" class="btn-close border w-10" data-bs-dismiss="modal"></button>
        </div>
        <div class="modal-body">
          <p class="lead"><?php echo $main_text ?></p>
          <p class="text-secondary"> <?php echo $sub_text ?></p>
        </div>
        <div class="modal-footer justify-content-around">
          <button type="button" class="btn btn-success btn-cancel" data-bs-dismiss="modal">Cancel</button>
          <a href="#" class="btn btn-danger btn-delete">Delete</a>
        </div>
      </div>
    </div>
  </div>
</div>