<div class="modal fade" id="myModal" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true">

    <div class="modal-dialog">

        <div class="modal-content">

            <!-- Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">New Student</h5>

                <button type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close">
                </button>
            </div>

            <!-- Body -->
            <div class="modal-body">

                <form id="StudentEntry">

                    @csrf

                    <div class="mb-3">

                        <label class="form-label">Name</label>

                        <input type="text"
                               name="name"
                               class="form-control">

                        <span class="text-danger error_text name_error"></span>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Email</label>

                        <input type="email"
                               name="email"
                               class="form-control">

                        <span class="text-danger error_text email_error"></span>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">Address</label>

                        <textarea name="address"
                                  rows="3"
                                  class="form-control"></textarea>

                        <span class="text-danger error_text address_error"></span>

                    </div>

                    <div class="modal-footer">

                        <button type="button"
                                class="btn btn-secondary"
                                data-bs-dismiss="modal">
                            Close
                        </button>

                        <button type="submit"
                                class="btn btn-primary"
                                id="saveStudent">
                            Save Student
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</div>