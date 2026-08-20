<!-- resources/views/vendor-registration.blade.php -->
@extends('layouts.guest')

@section('title', 'Become a Vendor - OrviBazar')

@section('content')
    <div
        style="max-width: 600px; width: 100%; margin: 0 auto; background: white; border-radius: var(--radius-2xl); box-shadow: var(--shadow-lg); padding: var(--spacing-2xl); position: relative; overflow: hidden;">

        <!-- Decorative Header -->
        <div
            style="position: absolute; top: 0; left: 0; right: 0; height: 6px; background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-accent) 100%);">
        </div>

        <!-- Go Back Button -->
        <a href="{{route('option')}}"
            style="display: inline-flex; align-items: center; gap: var(--spacing-xs); color: var(--color-text-muted); text-decoration: none; font-size: var(--font-size-sm); transition: all var(--transition-fast); padding: var(--spacing-xs) var(--spacing-sm); border-radius: var(--radius-md); margin-top: var(--spacing-sm);">
            <i class="fas fa-arrow-left"></i> Back
        </a>

        <!-- Header -->
        <div style="text-align: center; margin-bottom: var(--spacing-xl); margin-top: var(--spacing-sm);">
            <div
                style="display: inline-block; background: var(--color-off-white); padding: var(--spacing-md); border-radius: 50%; margin-bottom: var(--spacing-md);">
                <i class="fas fa-store" style="font-size: 32px; color: var(--color-primary);"></i>
            </div>
            <h1
                style="font-size: var(--font-size-2xl); font-weight: var(--font-weight-bold); color: var(--color-primary); margin-bottom: var(--spacing-xs);">
                Become a Vendor
            </h1>
            <p style="color: var(--color-text-muted); font-size: var(--font-size-sm);">
                Join our marketplace and start selling your products today!
            </p>
        </div>

        <!-- Progress Steps -->
        <div
            style="display: flex; justify-content: center; align-items: center; gap: var(--spacing-sm); margin-bottom: var(--spacing-xl); padding: 0 var(--spacing-xl);">
            <div style="display: flex; align-items: center; gap: var(--spacing-sm);">
                <span
                    style="width: 32px; height: 32px; border-radius: 50%; background: var(--color-accent); color: var(--color-primary); display: flex; align-items: center; justify-content: center; font-weight: var(--font-weight-bold); font-size: var(--font-size-sm);">1</span>
                <span
                    style="font-size: var(--font-size-xs); color: var(--color-primary); font-weight: var(--font-weight-medium);">Account</span>
            </div>
            <div style="flex: 1; height: 2px; max-width: 60px; background: var(--color-border-light);"></div>
            <div style="display: flex; align-items: center; gap: var(--spacing-sm);">
                <span
                    style="width: 32px; height: 32px; border-radius: 50%; background: var(--color-border-light); color: var(--color-text-muted); display: flex; align-items: center; justify-content: center; font-weight: var(--font-weight-bold); font-size: var(--font-size-sm);">2</span>
                <span style="font-size: var(--font-size-xs); color: var(--color-text-muted);">Business</span>
            </div>
            <div style="flex: 1; height: 2px; max-width: 60px; background: var(--color-border-light);"></div>
            <div style="display: flex; align-items: center; gap: var(--spacing-sm);">
                <span
                    style="width: 32px; height: 32px; border-radius: 50%; background: var(--color-border-light); color: var(--color-text-muted); display: flex; align-items: center; justify-content: center; font-weight: var(--font-weight-bold); font-size: var(--font-size-sm);">3</span>
                <span style="font-size: var(--font-size-xs); color: var(--color-text-muted);">Complete</span>
            </div>
        </div>

        <!-- Registration Form -->
        <form id="vendorRegistrationForm" onsubmit="return handleVendorRegistration(event)"
            style="display: flex; flex-direction: column; gap: var(--spacing-lg);">

            <!-- Personal Information Section -->
            <div>
                <h3
                    style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-md); color: var(--color-primary);">
                    <i class="fas fa-user" style="color: var(--color-accent); margin-right: var(--spacing-sm);"></i>
                    Personal Information
                </h3>

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: var(--spacing-md);">
                    <!-- First Name -->
                    <div class="form-group">
                        <label for="firstName"
                            style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                            First Name <span style="color: var(--color-error);">*</span>
                        </label>
                        <input type="text" id="firstName" name="first_name" required
                            style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                            placeholder="John">
                    </div>

                    <!-- Last Name -->
                    <div class="form-group">
                        <label for="lastName"
                            style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                            Last Name <span style="color: var(--color-error);">*</span>
                        </label>
                        <input type="text" id="lastName" name="last_name" required
                            style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                            placeholder="Doe">
                    </div>
                </div>

                <!-- Email -->
                <div class="form-group" style="margin-top: var(--spacing-md);">
                    <label for="email"
                        style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                        Email Address <span style="color: var(--color-error);">*</span>
                    </label>
                    <input type="email" id="email" name="email" required
                        style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                        placeholder="you@example.com">
                </div>

                <!-- Phone -->
                <div class="form-group" style="margin-top: var(--spacing-md);">
                    <label for="phone"
                        style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                        Phone Number <span style="color: var(--color-error);">*</span>
                    </label>
                    <input type="tel" id="phone" name="phone" required
                        style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                        placeholder="+1 234 567 8900">
                </div>

                <!-- Password -->
                {{-- <div class="form-group" style="margin-top: var(--spacing-md);">
                    <label for="password" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                        Password <span style="color: var(--color-error);">*</span>
                    </label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" required minlength="8"
                               style="width: 100%; padding: 10px 14px; padding-right: 48px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                               placeholder="Minimum 8 characters">
                        <button type="button" onclick="togglePassword('password')"
                                style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--color-text-muted);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div style="margin-top: var(--spacing-xs); font-size: var(--font-size-xs); color: var(--color-text-muted);">
                        <i class="fas fa-info-circle"></i> Must be at least 8 characters
                    </div>
                </div>

                <!-- Confirm Password -->
                <div class="form-group" style="margin-top: var(--spacing-md);">
                    <label for="password_confirmation" style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                        Confirm Password <span style="color: var(--color-error);">*</span>
                    </label>
                    <div style="position: relative;">
                        <input type="password" id="password_confirmation" name="password_confirmation" required
                               style="width: 100%; padding: 10px 14px; padding-right: 48px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                               placeholder="Confirm your password">
                        <button type="button" onclick="togglePassword('password_confirmation')"
                                style="position: absolute; right: 12px; top: 50%; transform: translateY(-50%); background: none; border: none; cursor: pointer; color: var(--color-text-muted);">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>
            </div> --}}

                <!-- Business Information Section -->
                <div style="border-top: 1px solid var(--color-border-light); padding-top: var(--spacing-lg);">
                    <h3
                        style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-md); color: var(--color-primary);">
                        <i class="fas fa-building" style="color: var(--color-accent); margin-right: var(--spacing-sm);"></i>
                        Business Information
                    </h3>

                    <!-- Business Name -->
                    <div class="form-group">
                        <label for="businessName"
                            style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                            Business Name <span style="color: var(--color-error);">*</span>
                        </label>
                        <input type="text" id="businessName" name="business_name" required
                            style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                            placeholder="Your Business Name">
                    </div>

                    <!-- Business Type -->
                    <div class="form-group" style="margin-top: var(--spacing-md);">
                        <label for="businessType"
                            style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                            Business Type <span style="color: var(--color-error);">*</span>
                        </label>
                        <select id="businessType" name="business_type" required
                            style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none; background: white;">
                            <option value="">Select Business Type</option>
                            <option value="sole_proprietorship">Sole Proprietorship</option>
                            <option value="partnership">Partnership</option>
                            <option value="llc">Limited Liability Company (LLC)</option>
                            <option value="corporation">Corporation</option>
                            <option value="non_profit">Non-Profit Organization</option>
                            <option value="freelance">Freelance / Independent</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Business Category -->
                    <div class="form-group" style="margin-top: var(--spacing-md);">
                        <label for="businessCategory"
                            style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                            Business Category <span style="color: var(--color-error);">*</span>
                        </label>
                        <select id="businessCategory" name="business_category" required
                            style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none; background: white;">
                            <option value="">Select Category</option>
                            <option value="electronics">Electronics</option>
                            <option value="fashion">Fashion & Apparel</option>
                            <option value="home">Home & Living</option>
                            <option value="beauty">Beauty & Personal Care</option>
                            <option value="sports">Sports & Outdoors</option>
                            <option value="books">Books & Media</option>
                            <option value="toys">Toys & Games</option>
                            <option value="automotive">Automotive</option>
                            <option value="food">Food & Beverage</option>
                            <option value="health">Health & Wellness</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Business Description -->
                    <div class="form-group" style="margin-top: var(--spacing-md);">
                        <label for="businessDescription"
                            style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                            Business Description <span style="color: var(--color-error);">*</span>
                        </label>
                        <textarea id="businessDescription" name="business_description" required rows="4"
                            style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none; resize: vertical; font-family: inherit;"
                            placeholder="Tell us about your business, products, and what makes you unique..."></textarea>
                        <div
                            style="margin-top: var(--spacing-xs); font-size: var(--font-size-xs); color: var(--color-text-muted); text-align: right;">
                            <span id="charCount">0</span> / 500 characters
                        </div>
                    </div>

                    <!-- Website (Optional) -->
                    <div class="form-group" style="margin-top: var(--spacing-md);">
                        <label for="website"
                            style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                            Website URL <span
                                style="color: var(--color-text-muted); font-weight: var(--font-weight-regular);">(Optional)</span>
                        </label>
                        <input type="url" id="website" name="website"
                            style="width: 100%; padding: 10px 14px; border: 1px solid var(--color-border-light); border-radius: var(--radius-md); font-size: var(--font-size-base); transition: all var(--transition-fast); outline: none;"
                            placeholder="https://yourwebsite.com">
                    </div>
                </div>

                <!-- Upload Documents Section -->
                <div style="border-top: 1px solid var(--color-border-light); padding-top: var(--spacing-lg);">
                    <h3
                        style="font-size: var(--font-size-md); font-weight: var(--font-weight-semibold); margin-bottom: var(--spacing-md); color: var(--color-primary);">
                        <i class="fas fa-file-upload"
                            style="color: var(--color-accent); margin-right: var(--spacing-sm);"></i> Business Documents
                    </h3>

                    <!-- Business License -->
                    <div class="form-group">
                        <label for="businessLicense"
                            style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                            Business License <span style="color: var(--color-error);">*</span>
                        </label>
                        <div style="border: 2px dashed var(--color-border-light); border-radius: var(--radius-md); padding: var(--spacing-xl); text-align: center; cursor: pointer; transition: all var(--transition-fast);"
                            id="uploadArea1" ondrop="handleDrop(event, 'businessLicense')"
                            ondragover="handleDragOver(event)"
                            onclick="document.getElementById('businessLicense').click()">
                            <input type="file" id="businessLicense" name="business_license"
                                accept=".pdf,.jpg,.jpeg,.png" required style="display: none;"
                                onchange="handleFileSelect(event, 'businessLicense')">
                            <i class="fas fa-cloud-upload-alt"
                                style="font-size: 48px; color: var(--color-text-muted);"></i>
                            <p
                                style="margin: var(--spacing-sm) 0; color: var(--color-text-muted); font-size: var(--font-size-sm);">
                                <strong>Click to upload</strong> or drag and drop
                            </p>
                            <p style="color: var(--color-text-muted); font-size: var(--font-size-xs);">PDF, JPG, PNG (Max
                                5MB)</p>
                        </div>
                        <div id="fileInfo1"
                            style="display: none; margin-top: var(--spacing-xs); padding: var(--spacing-sm); background: var(--color-off-white); border-radius: var(--radius-sm); font-size: var(--font-size-sm);">
                            <i class="fas fa-file-pdf" style="color: var(--color-accent);"></i>
                            <span id="fileName1"></span>
                            <button type="button" onclick="removeFile('businessLicense', 1)"
                                style="margin-left: var(--spacing-sm); color: var(--color-error); background: none; border: none; cursor: pointer;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Tax ID / EIN (Optional) -->
                    <div class="form-group" style="margin-top: var(--spacing-md);">
                        <label for="taxId"
                            style="display: block; font-weight: var(--font-weight-medium); margin-bottom: var(--spacing-xs); font-size: var(--font-size-sm);">
                            Tax ID / EIN <span
                                style="color: var(--color-text-muted); font-weight: var(--font-weight-regular);">(Optional)</span>
                        </label>
                        <div style="border: 2px dashed var(--color-border-light); border-radius: var(--radius-md); padding: var(--spacing-xl); text-align: center; cursor: pointer; transition: all var(--transition-fast);"
                            id="uploadArea2" ondrop="handleDrop(event, 'taxId')" ondragover="handleDragOver(event)"
                            onclick="document.getElementById('taxId').click()">
                            <input type="file" id="taxId" name="tax_id" accept=".pdf,.jpg,.jpeg,.png"
                                style="display: none;" onchange="handleFileSelect(event, 'taxId')">
                            <i class="fas fa-file-invoice" style="font-size: 48px; color: var(--color-text-muted);"></i>
                            <p
                                style="margin: var(--spacing-sm) 0; color: var(--color-text-muted); font-size: var(--font-size-sm);">
                                <strong>Click to upload</strong> or drag and drop
                            </p>
                            <p style="color: var(--color-text-muted); font-size: var(--font-size-xs);">PDF, JPG, PNG (Max
                                5MB)</p>
                        </div>
                        <div id="fileInfo2"
                            style="display: none; margin-top: var(--spacing-xs); padding: var(--spacing-sm); background: var(--color-off-white); border-radius: var(--radius-sm); font-size: var(--font-size-sm);">
                            <i class="fas fa-file-pdf" style="color: var(--color-accent);"></i>
                            <span id="fileName2"></span>
                            <button type="button" onclick="removeFile('taxId', 2)"
                                style="margin-left: var(--spacing-sm); color: var(--color-error); background: none; border: none; cursor: pointer;">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Terms & Conditions -->
                <div
                    style="display: flex; align-items: start; gap: var(--spacing-sm); padding: var(--spacing-md); background: var(--color-off-white); border-radius: var(--radius-md);">
                    <input type="checkbox" id="terms" name="terms" required
                        style="width: 18px; height: 18px; margin-top: 2px; accent-color: var(--color-primary); cursor: pointer;">
                    <label for="terms"
                        style="font-size: var(--font-size-sm); color: var(--color-text-secondary); cursor: pointer;">
                        I agree to the <a href="{{ route('terms.service') }}"
                            style="color: var(--color-primary); text-decoration: none;">Terms of Service</a> and
                        <a href="{{ route('vendor.agreement') }}"
                            style="color: var(--color-primary); text-decoration: none;">Vendor Agreement</a>.
                        I confirm that all information provided is accurate and complete.
                        <span style="color: var(--color-error);">*</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="submitBtn"
                    style="padding: 14px 30px; background: var(--color-accent); color: white; border: none; border-radius: var(--radius-md); font-size: var(--font-size-lg); font-weight: var(--font-weight-bold); cursor: pointer; transition: all var(--transition-base); display: flex; align-items: center; justify-content: center; gap: var(--spacing-sm); margin: var(--spacing-sm) auto 0;">
                    <i class="fas fa-store"></i> Register as Vendor
                </button>

                <!-- Login Link -->
                <p
                    style="text-align: center; margin-top: var(--spacing-md); font-size: var(--font-size-sm); color: var(--color-text-muted);">
                    Already have an account? <a href="/login"
                        style="color: var(--color-primary); text-decoration: none; font-weight: var(--font-weight-medium);">Login
                        here</a>
                </p>
        </form>
    </div>

    <script>
        // ============================================
        // FORM VALIDATION & HANDLING
        // ============================================

        function handleVendorRegistration(event) {
            event.preventDefault();

            const form = document.getElementById('vendorRegistrationForm');
            const submitBtn = document.getElementById('submitBtn');
            const originalText = submitBtn.innerHTML;

            // Basic validation
            const password = document.getElementById('password').value;
            const confirmPassword = document.getElementById('password_confirmation').value;

            if (password !== confirmPassword) {
                showToast('error', 'Passwords do not match!');
                document.getElementById('password_confirmation').style.borderColor = 'var(--color-error)';
                return false;
            }

            if (password.length < 8) {
                showToast('error', 'Password must be at least 8 characters!');
                document.getElementById('password').style.borderColor = 'var(--color-error)';
                return false;
            }

            // Check if terms are accepted
            const terms = document.getElementById('terms');
            if (!terms.checked) {
                showToast('error', 'Please accept the Terms & Conditions!');
                terms.style.outline = '2px solid var(--color-error)';
                setTimeout(() => {
                    terms.style.outline = 'none';
                }, 3000);
                return false;
            }

            // Show loading state
            submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Registering...';
            submitBtn.disabled = true;

            // Simulate API call
            setTimeout(() => {
                // Success
                submitBtn.innerHTML = '<i class="fas fa-check"></i> Registered Successfully!';
                submitBtn.style.background = 'var(--color-success)';

                showToast('success',
                    '🎉 Vendor registration submitted successfully! We\'ll review your application.');

                // Reset form (optional)
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.style.background = '';
                    submitBtn.disabled = false;
                    // form.reset();
                }, 3000);
            }, 2000);

            return false;
        }

        // ============================================
        // FILE UPLOAD HANDLING
        // ============================================

        function handleFileSelect(event, inputName) {
            const file = event.target.files[0];
            if (file) {
                handleFile(file, inputName);
            }
        }

        function handleDrop(event, inputName) {
            event.preventDefault();
            const file = event.dataTransfer.files[0];
            if (file) {
                handleFile(file, inputName);
            }
        }

        function handleDragOver(event) {
            event.preventDefault();
            event.currentTarget.style.borderColor = 'var(--color-accent)';
            event.currentTarget.style.background = 'var(--color-off-white)';
        }

        function handleFile(file, inputName) {
            // Validate file size (max 5MB)
            if (file.size > 5 * 1024 * 1024) {
                showToast('error', 'File size exceeds 5MB limit!');
                return;
            }

            // Validate file type
            const validTypes = ['application/pdf', 'image/jpeg', 'image/png', 'image/jpg'];
            if (!validTypes.includes(file.type)) {
                showToast('error', 'Please upload PDF, JPG, or PNG files only!');
                return;
            }

            // Get index from input name
            const index = inputName === 'businessLicense' ? 1 : 2;

            // Update file info
            document.getElementById(`fileName${index}`).textContent = file.name;
            document.getElementById(`fileInfo${index}`).style.display = 'block';
            document.getElementById(`uploadArea${index}`).style.borderColor = 'var(--color-success)';
            document.getElementById(`uploadArea${index}`).style.background = 'rgba(46, 204, 113, 0.05)';

            showToast('success', `✅ ${file.name} uploaded successfully!`);
        }

        function removeFile(inputName, index) {
            document.getElementById(inputName).value = '';
            document.getElementById(`fileInfo${index}`).style.display = 'none';
            document.getElementById(`uploadArea${index}`).style.borderColor = 'var(--color-border-light)';
            document.getElementById(`uploadArea${index}`).style.background = 'transparent';
            showToast('info', 'File removed');
        }

        // ============================================
        // CHARACTER COUNTER FOR DESCRIPTION
        // ============================================

        document.addEventListener('DOMContentLoaded', function() {
            const description = document.getElementById('businessDescription');
            const charCount = document.getElementById('charCount');

            description.addEventListener('input', function() {
                const count = this.value.length;
                charCount.textContent = count;

                if (count > 450) {
                    charCount.style.color = 'var(--color-warning)';
                } else if (count > 500) {
                    charCount.style.color = 'var(--color-error)';
                    this.value = this.value.substring(0, 500);
                    charCount.textContent = 500;
                    showToast('warning', 'Maximum 500 characters allowed!');
                } else {
                    charCount.style.color = 'var(--color-text-muted)';
                }
            });
        });

        // ============================================
        // PASSWORD TOGGLE
        // ============================================

        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const button = input.nextElementSibling;
            const icon = button.querySelector('i');

            if (input.type === 'password') {
                input.type = 'text';
                icon.className = 'fas fa-eye-slash';
            } else {
                input.type = 'password';
                icon.className = 'fas fa-eye';
            }
        }

        // ============================================
        // INPUT VALIDATION WITH STYLING
        // ============================================

        document.addEventListener('DOMContentLoaded', function() {
            const formInputs = document.querySelectorAll('input, select, textarea');

            formInputs.forEach(input => {
                // Focus
                input.addEventListener('focus', function() {
                    this.style.borderColor = 'var(--color-primary)';
                    this.style.boxShadow = '0 0 0 3px rgba(26, 26, 26, 0.1)';
                });

                // Blur
                input.addEventListener('blur', function() {
                    this.style.borderColor = 'var(--color-border-light)';
                    this.style.boxShadow = 'none';

                    // Basic validation for required fields
                    if (this.hasAttribute('required') && !this.value.trim()) {
                        this.style.borderColor = 'var(--color-error)';
                    }
                });

                // Input
                input.addEventListener('input', function() {
                    if (this.hasAttribute('required') && this.value.trim()) {
                        this.style.borderColor = 'var(--color-success)';
                    }
                });
            });
        });

        // ============================================
        // TOAST NOTIFICATION SYSTEM
        // ============================================

        function showToast(type, message) {
            // Remove existing toast if any
            const existingToast = document.querySelector('.toast-notification');
            if (existingToast) {
                existingToast.remove();
            }

            // Create toast element
            const toast = document.createElement('div');
            toast.className = 'toast-notification';

            const colors = {
                'success': 'var(--color-success)',
                'error': 'var(--color-error)',
                'warning': 'var(--color-warning)',
                'info': 'var(--color-info)'
            };

            const icons = {
                'success': 'fa-check-circle',
                'error': 'fa-times-circle',
                'warning': 'fa-exclamation-circle',
                'info': 'fa-info-circle'
            };

            toast.style.cssText = `
                position: fixed;
                bottom: var(--spacing-xl);
                right: var(--spacing-xl);
                background: ${colors[type] || 'var(--color-primary)'};
                color: white;
                padding: var(--spacing-md) var(--spacing-lg);
                border-radius: var(--radius-md);
                box-shadow: var(--shadow-lg);
                z-index: 9999;
                display: flex;
                align-items: center;
                gap: var(--spacing-sm);
                animation: slideInUp 0.3s ease;
                font-weight: var(--font-weight-medium);
                max-width: 400px;
                min-width: 280px;
                font-size: var(--font-size-sm);
            `;

            toast.innerHTML = `
                <i class="fas ${icons[type] || 'fa-info-circle'}" style="font-size: 20px;"></i>
                <span>${message}</span>
                <button onclick="this.parentElement.remove()" style="background: none; border: none; color: white; cursor: pointer; font-size: 18px; margin-left: auto; padding: 0 4px;">
                    <i class="fas fa-times"></i>
                </button>
            `;

            document.body.appendChild(toast);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 5000);
        }

        // ============================================
        // PREVENT FORM SUBMISSION ON ENTER KEY
        // ============================================

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.tagName !== 'TEXTAREA') {
                const submitBtn = document.getElementById('submitBtn');
                if (submitBtn && !submitBtn.disabled) {
                    // Allow Enter key to submit only if not in textarea
                    return true;
                }
            }
        });

        // ============================================
        // AUTO-FILL TEST DATA (For development)
        // ============================================

        // Uncomment this section to auto-fill test data
        /*
        function fillTestData() {
            document.getElementById('firstName').value = 'John';
            document.getElementById('lastName').value = 'Doe';
            document.getElementById('email').value = 'john@example.com';
            document.getElementById('phone').value = '+1 234 567 8900';
            document.getElementById('password').value = 'password123';
            document.getElementById('password_confirmation').value = 'password123';
            document.getElementById('businessName').value = 'JD Electronics';
            document.getElementById('businessType').value = 'sole_proprietorship';
            document.getElementById('businessCategory').value = 'electronics';
            document.getElementById('businessDescription').value = 'We sell premium quality electronics and gadgets. Specializing in audio equipment and smart home devices.';
            document.getElementById('website').value = 'https://jdelectronics.com';
            document.getElementById('terms').checked = true;
        }
        // fillTestData(); // Uncomment to auto-fill
        */
    </script>

    <style>
        /* Form input focus effects */
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--color-primary) !important;
            box-shadow: 0 0 0 3px rgba(26, 26, 26, 0.1) !important;
        }

        /* Upload area hover */
        #uploadArea1:hover,
        #uploadArea2:hover {
            border-color: var(--color-primary) !important;
            background: var(--color-off-white) !important;
        }

        /* Animation for toast */
        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideOutRight {
            from {
                opacity: 1;
                transform: translateX(0);
            }

            to {
                opacity: 0;
                transform: translateX(30px);
            }
        }

        /* Responsive */
        @media (max-width: 768px) {
            .vendor-registration {
                padding: var(--spacing-lg) !important;
                margin: var(--spacing-md);
            }

            .vendor-registration .grid-2 {
                grid-template-columns: 1fr !important;
            }

            .progress-steps {
                padding: 0 var(--spacing-md) !important;
            }
        }

        @media (max-width: 480px) {
            .vendor-registration {
                padding: var(--spacing-md) !important;
                margin: var(--spacing-sm);
            }
        }
    </style>
@endsection
