<!doctype html>
<html lang="zxx">

<body>

    <?php include APPPATH . 'views/includes/header.php'; ?>
    <div class="page-banner-area item-bg-two">
        <div class="d-table">
            <div class="d-table-cell">
                <div class="container">
                    <div class="page-banner-content">
                        <h2>Reset Password</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="profile-authentication-area ptb-100">
        <div class="container">
            <div class="profile-authentication-tabs">
                <div class="authentication-tabs-list">

                </div>
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="login" role="tabpanel">
                        <div class="aess-authentication-form">
                            <?php echo form_open('Manage_login/resetPassword'); ?>
                            <div class="form-group">
								<input type="hidden" name="apiKey" value="<?php echo $apiKey; ?>" />
                                <input type="password" class="form-control" name="password" placeholder="Password"
                                    required>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="confirm_password"
                                    placeholder="Confirm Password" required>
                            </div>
                            <button type="submit" class="default-btn">Reset<i class="flaticon-send"></i></button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include APPPATH . 'views/includes/d-footer.php'; ?>
</body>

</html>