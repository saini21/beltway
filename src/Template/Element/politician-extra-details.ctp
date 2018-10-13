<div class="row">
    <div class="col-lg-1">&nbsp;</div>
    <div class="col-lg-11">
        <div class="form-group newemail">
            <div class="col-md-9">
                <form class="newemail-form" id="nonGovernmentalEmailForm"
                      action="Javascript:void(0)">
                    <label>Non-governmental email address <i class="fa fa-asterisk"></i> </label>
                    <input type="text" style="height:40px" class="form-control"
                           id="nonGovernmentalEmail"
                           name="non_governmental_email" placeholder="Email Address"
                           value="<?= empty($authUser['non_governmental_email']) ? '' : $authUser['non_governmental_email'] ?>"/>
                    <label for="nonGovernmentalEmail" class="error"
                           style="margin: 10px 0 0 5px; display: none;">Please enter valid
                        email.</label>
                </form>
            </div>
            <div class="col-md-3" id="emailSaved" style="display: none;">
                <i class="fa fa-check" style="margin: 30px 0 0 0; color:#63bd5c; font-size: 30px;"
                   title="Saved"></i>
            </div>
            <div class="col-md-9">
                <form class="newemail-form" id="phoneNumberForm" action="Javascript:void(0)">
                    <label>Government Phone Number</label>
                    <input type="number" style="height:40px" class="form-control" id="phoneNumber"
                           name="phone_number" placeholder="Government Phone Number"
                           oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                           value="<?= empty($authUser['phone_number']) ? '' : $authUser['phone_number'] ?>" maxlength="7" />
                    <label for="phoneNumber" class="error"
                           style="margin: 10px 0 0 5px; display: none;">Please enter government phone
                        number.</label>
                </form>
            </div>
            <div class="col-md-3" id="phoneNumberSaved" style="display: none;">
                <i class="fa fa-check" style="margin: 30px 0 0 0; color:#63bd5c; font-size: 30px;"
                   title="Saved"></i>
            </div>
            <div class="form-group">
                <br/>
                <div class="col-md-12 pull-right text-right">
                    <!-- input type="submit" class="red-submit" id="memberStatus"/ -->
                    <a href="<?= $this->Url->build(['controller' => 'Articles', 'action' => 'platform']); ?>"><input
                            type="submit" class="btn btn-info btn-lg" value="Join"/></a>
                </div>
            </div>
        </div>
    </div>
</div>
