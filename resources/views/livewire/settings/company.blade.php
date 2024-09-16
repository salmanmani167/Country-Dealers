<div>
    <div class="row">
        <div class="col-md-8 offset-md-2">

            <!-- Page Header -->
            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Company Settings</h3>
                    </div>
                </div>
            </div>
            <!-- /Page Header -->

                <form wire:submit.prevent="update" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <x-form.wire.input name="company_name" label="Company Name"></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <x-form.wire.input name="contact_person" label="Contact Person"></x-form.wire.input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <x-form.wire.input name="address" label="Address"></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <x-form.wire.input name="country" label="Country"></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <x-form.wire.input name="city" label="City"></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <x-form.wire.input name="province" label="State/Province"></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-6 col-lg-3">
                            <div class="form-group">
                                <x-form.wire.input name="postal_code" label="Postal Code"></x-form.wire.input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <x-form.wire.input name="email" label="Email"></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <x-form.wire.input name="phone" label="Phone Number"></x-form.wire.input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <x-form.wire.input name="mobile" label="Mobile Number"></x-form.wire.input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <x-form.wire.input name="fax" label="Fax"></x-form.wire.input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <x-form.wire.input name="website_url" label="Website Url"></x-form.wire.input>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button type="submit" class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
</div>
