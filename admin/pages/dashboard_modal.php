<!-- // This modal for the adding of schedule -->
<div id="con-close-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Add Schedule</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Schedule Description:</label>
                            <textarea class="form-control" id="sched_description" cols="30" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="field-1" class="control-label">Select Course:</label>
                            <select id="sched_course" class="form-control"> 
                                <option value="TDC">TDC</option>
                                <option value="PDC">PDC</option>
                                <option value="Additional Driving">Additional Driving</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info waves-effect waves-light" onclick="save_schedule()">Add Schedule</button>
            </div>
        </div>
    </div>
</div>
<!-- // END modal for the adding of schedule -->



<!-- // This modal for the update of schedule -->
<div id="update-schedule-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title">Update Schedule</h4>
            </div>
            <div class="modal-body">
                <div id="show_update_schedule"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success waves-effect waves-light" onclick="update_schedule()">Update Schedule</button>
            </div>
        </div>
    </div>
</div>
<!-- // END modal for the update of schedule -->
