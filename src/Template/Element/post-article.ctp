<div class="modal fade " id="postArticle" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-bg">
                <h5 class="modal-title" id="exampleModalLongTitle">Upload Agenda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i  class="fa fa-times" style="color: #ffffff;"></i>
                </button>
            </div>
            <form action="javascript:void(0);" id="agendaForm">
            <input type="hidden" name="id" id="articleId" value="0" />
            <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-2"><label for="agendaSubject">Subject</label></div>
                        <div class="col-lg-10">
                            <input type="text" name="title" class="form-control" placeholder="Subject" id="agendaSubject">
                            <label for="agendaSubject" class="error" style="margin-top: 10px;"></label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">&nbsp;</div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2"><label for="agendaContent">Agenda</label></div>
                        <div class="col-lg-10">
                            <textarea type="text" name="content" class="form-control" placeholder="Agenda" id="agendaContent" style="height:250px;"></textarea>
                            <label for="agendaContent" class="error" style="margin-top: 10px;"></label>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <input type="submit" class="btn btn-success" value="Publish Agenda" id="publishAgendaBtn" />
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
            </form>
        </div>
    </div>
</div>
