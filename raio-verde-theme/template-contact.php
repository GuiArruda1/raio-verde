<?php
/**
 * Template Name: Contact
 *
 * @package Raio_Verde
 */

// Handle Contact Form Submission
$rv_success = false;
$rv_error = '';

if ( $_SERVER['REQUEST_METHOD'] === 'POST' && isset( $_POST['rv_contact_submit'] ) ) {
    // Verify nonce for security
    if ( ! isset( $_POST['rv_contact_nonce'] ) || ! wp_verify_nonce( $_POST['rv_contact_nonce'], 'rv_send_message' ) ) {
        $rv_error = esc_html__( 'Security verification failed. Please try again.', 'raio-verde' );
    } else {
        // Sanitize inputs
        $name    = sanitize_text_field( $_POST['rv_name'] );
        $email   = sanitize_email( $_POST['rv_email'] );
        $message = sanitize_textarea_field( $_POST['rv_message'] );
        $consent = isset( $_POST['rv_consent'] ) ? true : false;

        // Validation
        if ( empty( $name ) || empty( $email ) || empty( $message ) ) {
            $rv_error = esc_html__( 'Please fill in all fields.', 'raio-verde' );
        } elseif ( ! is_email( $email ) ) {
            $rv_error = esc_html__( 'Please enter a valid email address.', 'raio-verde' );
        } elseif ( ! $consent ) {
            $rv_error = esc_html__( 'You must agree to the privacy and cookie policies.', 'raio-verde' );
        } else {
            // Retrieve recipient email from ACF or fall back to WordPress admin email
            $recipient_email = rv_get_field( 'contact_notification_email' ) ?: get_option( 'admin_email' );
            
            $subject = sprintf( __( 'New Work Enquiry from %s', 'raio-verde' ), $name );
            
            $body  = "Name: $name\n";
            $body .= "Email: $email\n\n";
            $body .= "Message:\n$message\n";
            
            $headers = array(
                'Content-Type: text/plain; charset=UTF-8',
                'From: ' . get_bloginfo( 'name' ) . ' <' . get_option( 'admin_email' ) . '>',
                'Reply-To: ' . $name . ' <' . $email . '>'
            );

            if ( wp_mail( $recipient_email, $subject, $body, $headers ) ) {
                $rv_success = true;
            } else {
                $rv_error = esc_html__( 'An error occurred while sending your message. Please try again later.', 'raio-verde' );
            }
        }
    }
}

get_header();
?>

<main id="primary" class="site-main contact-page-main">

    <?php
    // Fetch ACF Fields with defaults
    $contact_hl1   = rv_get_field( 'contact_title_line_1' ) ?: "Do you want to";
    $contact_hl2   = rv_get_field( 'contact_title_line_2' ) ?: "work with us?";
    $contact_desc  = rv_get_field( 'contact_description' ) ?: "Ornare dictum arcus sapien consectetur non, sit pharetra ut scelerisque fusces urna purus vestibulum nisi lorem ipsum.";
    $contact_email = rv_get_field( 'contact_email' ) ?: "hello@raioverde.pt";
    $contact_phone = rv_get_field( 'contact_phone' ) ?: "(+351) 931 784 271";
    $contact_phone_2 = rv_get_field( 'contact_phone_2' );
    $insta_label   = rv_get_field( 'contact_instagram_label' ) ?: "instagram";
    $insta_url     = rv_get_field( 'contact_instagram_url' ) ?: "#";
    $contact_image = rv_get_field( 'contact_image' ) ?: 'https://images.unsplash.com/photo-1605721911519-3dfeb3be25e7?auto=format&fit=crop&q=80&w=800&h=1200';
    ?>

    <section class="contact-section">
        <div class="contact-page-wrapper">
            
            <!-- Left Panel (Content & Form) -->
            <div class="contact-left-panel bg-dark">
                <div class="contact-panel-content">
                    
                    <h1 class="contact-title">
                        <span class="title-line-1"><?php echo esc_html( $contact_hl1 ); ?></span>
                        <span class="title-line-2 serif-italic"><?php echo esc_html( $contact_hl2 ); ?></span>
                    </h1>
                    
                    <p class="contact-desc"><?php echo esc_html( $contact_desc ); ?></p>
                    
                    <div class="contact-info-row">
                        <div class="info-item">
                            <a href="mailto:<?php echo esc_attr( $contact_email ); ?>"><?php echo esc_html( $contact_email ); ?></a>
                        </div>
                        <div class="info-item">
                            <?php $clean_phone = preg_replace( '/[^0-9+]/', '', $contact_phone ); ?>
                            <a href="tel:<?php echo esc_attr( $clean_phone ); ?>"><?php echo esc_html( $contact_phone ); ?></a>
                        </div>
                        <?php if ( $contact_phone_2 ) : ?>
                        <div class="info-item">
                            <?php $clean_phone_2 = preg_replace( '/[^0-9+]/', '', $contact_phone_2 ); ?>
                            <a href="tel:<?php echo esc_attr( $clean_phone_2 ); ?>"><?php echo esc_html( $contact_phone_2 ); ?></a>
                        </div>
                        <?php endif; ?>
                        <div class="info-item">
                            <a href="<?php echo esc_url( $insta_url ); ?>" target="_blank" rel="noopener"><?php echo esc_html( $insta_label ); ?></a>
                        </div>
                    </div>
                    
                    <!-- Form Submission States -->
                    <?php if ( $rv_success ) : ?>
                        <div class="contact-alert contact-alert-success">
                            <p><?php esc_html_e( 'Thank you! Your message has been sent successfully.', 'raio-verde' ); ?></p>
                        </div>
                    <?php else : ?>
                        
                        <?php if ( ! empty( $rv_error ) ) : ?>
                            <div class="contact-alert contact-alert-error">
                                <p><?php echo $rv_error; ?></p>
                            </div>
                        <?php endif; ?>
                        
                        <form action="<?php echo esc_url( get_permalink() ); ?>" method="POST" class="contact-form">
                            <?php wp_nonce_field( 'rv_send_message', 'rv_contact_nonce' ); ?>
                            
                            <div class="form-row flex-row">
                                <div class="form-group half-width">
                                    <input type="text" id="rv_name" name="rv_name" placeholder="<?php esc_attr_e( 'name', 'raio-verde' ); ?>" value="<?php echo isset( $_POST['rv_name'] ) ? esc_attr( $_POST['rv_name'] ) : ''; ?>" required>
                                </div>
                                <div class="form-group half-width">
                                    <input type="email" id="rv_email" name="rv_email" placeholder="<?php esc_attr_e( 'email', 'raio-verde' ); ?>" value="<?php echo isset( $_POST['rv_email'] ) ? esc_attr( $_POST['rv_email'] ) : ''; ?>" required>
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group full-width">
                                    <textarea id="rv_message" name="rv_message" rows="5" placeholder="<?php esc_attr_e( 'message', 'raio-verde' ); ?>" required><?php echo isset( $_POST['rv_message'] ) ? esc_textarea( $_POST['rv_message'] ) : ''; ?></textarea>
                                </div>
                            </div>
                            
                            <div class="form-footer">
                                <div class="form-consent">
                                    <label class="consent-container">
                                        <input type="checkbox" id="rv_consent" name="rv_consent" required <?php checked( isset( $_POST['rv_consent'] ) ); ?>>
                                        <span class="checkmark"></span>
                                        <span class="consent-text">
                                             <?php 
                                             $privacy_url = get_privacy_policy_url();
                                             if ( ! $privacy_url ) {
                                                 $privacy_page = get_page_by_path( 'privacy-policy' );
                                                 $privacy_url = $privacy_page ? get_permalink( $privacy_page->ID ) : home_url( '/privacy-policy/' );
                                             }
                                             
                                             printf(
                                                 /* translators: %s: privacy policy URL */
                                                 esc_html__( "I've read and agree to the %s.", 'raio-verde' ),
                                                 '<a href="' . esc_url( $privacy_url ) . '" target="_blank" rel="noopener" class="privacy-link">' . esc_html__( 'privacy and cookie policies', 'raio-verde' ) . '</a>'
                                             );
                                             ?>
                                         </span>
                                    </label>
                                </div>
                                
                                <div class="form-submit-container">
                                    <button type="submit" name="rv_contact_submit" class="action-link contact-submit-btn">
                                        <span class="icon"><svg width="21" height="11" viewBox="0 0 21 11" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M17.4551 10L20.5 6.875L17.4551 3.75M20.5 6.875H2.9359C2.28986 6.875 1.67028 6.61161 1.21346 6.14277C0.756638 5.67393 0.5 5.03804 0.5 4.375V0" stroke="currentColor" stroke-linejoin="round"/></svg></span>
                                        <span class="text-wrapper" data-text="<?php esc_attr_e( 'send message', 'raio-verde' ); ?>">
                                            <span class="text-original"><?php esc_html_e( 'send message', 'raio-verde' ); ?></span>
                                        </span>
                                    </button>
                                </div>
                            </div>
                        </form>
                    <?php endif; ?>
                    
                </div>
            </div>
            
            <!-- Right Panel (Featured Visual Media) -->
            <div class="contact-right-panel" style="background-image: url('<?php echo esc_url( $contact_image ); ?>');">
                <img src="<?php echo esc_url( $contact_image ); ?>" alt="<?php echo esc_attr( $contact_hl2 ); ?>" class="contact-visual-img">
            </div>

        </div>
    </section>

</main><!-- #main -->

<?php
get_footer();
