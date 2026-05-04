<footer class="footer dark-theme" style="background-color: #1C2C59">
    @if(Route::currentRouteName() === 'landing_page' || Route::currentRouteName() === 'landing_page2')
        <div class="new-footer-container">
            <div class="footer-left">
                <div class="logo-footer">
                    <a href="#"><img src="/new-home-images/wts-logo.png" loading="lazy" alt=""
                            style="margin-bottom: 25px;"></a>
                </div>
                <p style="color: white;">
                    Your trusted partner for securing admission abroad in the UK, USA, Canada, and Australia. We offer personalized
                    guidance, ensuring a smooth application process for tourist and student visas.
                </p>

                <!-- Contact -->
                <div class="footer-contact" style="margin-top: 5px;">
                    <p style="display: flex; align-items: center; gap: 5px">
                        <img src="/new-home-images/svg-icons/phone-footer.svg" alt="" style="height: 22px;">
                        <span style="color: white;">+91 8000915743</span>
                    </p>
                    <p style="display: flex; align-items: center; gap: 5px; margin-top: 5px;">
                        <img src="/new-home-images/svg-icons/mail-footer.svg" alt="" style="height: 22px;">
                        <span style="color: white;">info@wtsvisa.com</span>
                    </p>
                </div>


            </div>

            <div style="width: 100%;">
                <h3 style="color: #FC9118" colspan>Our Offices</h3>
                <div class="new-footer" style="grid-template-columns: repeat(4, 1fr);">



                    <div class="footer-offices">

                        <!-- Rajasthan Office -->
                        <div class="office-item">
                            <p><strong>Rajasthan Office:</strong> 402, 4th floor, Kanakshree apartment, 80ft road, Shobhagpura, Udaipur, Rajasthan 313001</p>
                        </div>

                    </div>


                    <div class="footer-links" style="margin-right: 10px;">
                        <div class="footer-column">
                            <div class="office-item">
                                <p><strong style="color: #FC9118;">Gujarat Office:</strong> 4th Floor, D 401 Lotus Aura 2,
                                    Near Indian Oil Petrol
                                    Pump, Sama Sawali Road, Vadodara, Gujarat 390008
                                </p>
                            </div>
                        </div>
                    </div>


                    <div class="footer-links" style="margin-right: 10px;">
                        <div class="footer-column">
                            <div class="office-item">
                                <p><strong style="color: #FC9118;">Jammu Office:</strong> 
                                    Jai Sukrala Wood Craft Industry, R/o Bachyal, Teh. Marh, District Jammu, P/O Paryal, Pin 181206
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="footer-links">
                        <div class="footer-column">
                            <!-- UK Office -->
                            <div class="office-item">
                                <p><strong style="color: #FC9118;">UK Office:</strong> 312, Pentax House, South Hill Avenue,
                                    South Harrow,
                                    Middlesex, HA2 0DU, United
                                    Kingdom</p>
                            </div>
                        </div>
                    </div>

                    <div class="footer-second-row">
                        <p>© 2026 WTS. Develop by Warrgyizmorsch.</p>
                    </div>
                    <div class="footer-second-row">
                        <p><a href="{{ url('/privacy-policy') }}">Privacy Policy</a> </p>
                    </div>
                    <div class="footer-second-row">
                        <p> <a href="{{ url('/terms-and-conditions') }}">Terms and
                                Service</a></p>
                    </div>

                </div>

            </div>
        </div>
    @elseif(Route::currentRouteName() === 'study_abroad_consultant' || Route::currentRouteName() === 'study_abroad_consultant_v1')
        <div class="new-footer-container">
            <div class="footer-left">
                <div class="logo-footer">
                    <a href="#"><img src="/new-home-images/wts-logo.png" loading="lazy" alt=""
                            style="margin-bottom: 25px;"></a>
                </div>
              
            </div>

            <div style="width: 100%;">
                <p style="color: white;">
                    Your trusted partner for studying abroad in the UK, USA, Canada, and Australia. From university selection to visa assistance, we provide end-to-end personalized guidance to ensure a smooth and successful application journey.
                </p>
                <div class="new-footer">

                    <div class="footer-second-row">
                        <p>© 2026 WTS. Designed & Developed by Warrgyizmorsch Pvt Ltd.</p>
                    </div>
                    <div class="footer-second-row">
                        <p><a href="{{ url('/privacy-policy') }}">Privacy Policy</a> </p>
                    </div>
                    <div class="footer-second-row">
                        <p> <a href="{{ url('/terms-and-conditions') }}">Terms and
                                Service</a></p>
                    </div>

                </div>

            </div>
        </div>
    @else
        <div class="new-footer-container">
            <div class="footer-left">
                <div class="logo-footer">
                    <a href="#"><img src="/new-home-images/wts-logo.png" loading="lazy" alt=""
                            style="margin-bottom: 25px;"></a>
                </div>
                <p style="color: white;">
                    Your trusted partner for securing visas to the UK, USA, Canada, and Australia. We offer personalized
                    guidance, ensuring a smooth application process for tourist and student visas.
                </p>
                <!-- Contact -->
                <div class="footer-contact" style="margin-top: 1rem;">
                    <p style="display: flex; align-items: center; gap: 5px; font-size: 1rem; color: #fff;">
                        <img src="/new-home-images/svg-icons/phone-footer.svg" alt="" style="height: 22px;">
                        <span>+91 9116076837</span>
                    </p>
                    <p style="display: flex; align-items: center; gap: 5px; margin-top: 5px; font-size: 1rem; color: #fff;">
                        <img src="/new-home-images/svg-icons/mail-footer.svg" alt="" style="height: 22px;">
                        <span>info@wtsvisa.com</span>
                    </p>
                </div>
                <div class="footer-social" style="justify-content: start;">
                    <!-- <a><i class="fab fa-twitter"></i></a> -->
                    <a href="https://www.facebook.com/wtsstudyconsultancy"><i class="fab fa-facebook"></i></a>
                    <a href="https://www.instagram.com/wts_consultancy"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com/company/wts-consultancy"><i class="fab fa-linkedin"></i></a>
                    <a href="https://www.youtube.com/@wtsstudyabroadconsultant"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <div style="width: 100%;">
                <div class="new-footer">



                    <div class="footer-offices">
                        <h3 style="color: #FC9118">Our Offices</h3>

                        <!-- Rajasthan Office -->
                        <div class="office-item">
                            <p><strong>Rajasthan Office:</strong> 402, 4th floor, Kanakshree apartment, 80ft road, Shobhagpura, Udaipur, Rajasthan 313001</p>
                        </div>

                        <!-- Gujarat Office -->
                        <div class="office-item">
                            <p><strong>Gujarat Office:</strong> 4th Floor, D 401 Lotus Aura 2, Near Indian Oil Petrol Pump,
                                Sama Sawali Road, Vadodara, Gujarat 390008
                            </p>
                        </div>

                        <!-- Jammu Office -->
                        <div class="office-item">
                            <p><strong>Jammu Office:</strong> Jai Sukrala Wood Craft Industry, R/o Bachyal, Teh. Marh, District Jammu, P/O Paryal, Pin 181206                             
                            </p>
                        </div>

                        <!-- UK Office -->
                        <div class="office-item">
                            <p><strong>UK Office:</strong> 312, Pentax House, South Hill Avenue, South Harrow, Middlesex,
                                HA2 0DU, United
                                Kingdom</p>
                        </div>


                    </div>


                    <div class="footer-links margin-left-for-desktop">
                        <div class="footer-column">
                            <h3 style="color: #FC9118;">Home</h3>
                            <ul>
                                <li><a href="{{ url('/about') }}">About Us</a></li>
                                <li><a href="{{ url('/contact') }}">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="footer-links">
                        <div class="footer-column">
                            <h3 style="color: #FC9118">Guidance & Information</h3>
                            <ul>
                                <li><a href="{{ url('/study-abroad') }}">Study Abroad</a></li>
                                <li><a href="{{ url('/cost-of-living') }}">Cost of Living</a></li>
                                <li><a href="{{ url('/letter-of-recommendation') }}">LOR</a></li>
                                <li><a href="{{ url('/career-counseling') }}">Career Counselling</a></li>
                                <li><a href="{{ url('/ielts-training') }}">IELTS Training</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="footer-second-row" style="grid-column: 1 / -1;">
                        <p style="font-size: 12px; text-align: center;">© 2026 WTS. Designed & Developed by Warrgyizmorsch Pvt Ltd.</p>
                    </div>
                    <!-- <div class="footer-second-row">
                        <p><a href="{{ url('/privacy-policy') }}">Privacy Policy</a> </p>
                    </div>
                    <div class="footer-second-row">
                        <p> <a href="{{ url('/terms-and-conditions') }}">Terms and Conditions</a></p>
                    </div> -->

                </div>

            </div>
        </div>
    @endif

    <style>
        .margin-left-for-desktop {
            margin-left: 30px;
        }
    
        @media (max-width: 768px) {
            .margin-left-for-desktop {
                margin-left: 0px;
            }
        }
    </style>



</footer>