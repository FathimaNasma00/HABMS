<x-guest-layout>
    <div class="mx-auto sm:px-6 lg:px-8">
        <div>
            <p class="mb-6 text-lg">Welcome to <strong>{{env('APP_NAME')}}</strong>, your trusted partner in
                connecting patients with healthcare providers seamlessly and efficiently. Our mission is to empower
                individuals and families to access high-quality medical care with ease, fostering a healthier and
                happier community.</p>

            <h2 class="text-2xl font-semibold text-blue-500 mb-3">Who We Are</h2>
            <p class="mb-6">At <strong>{{env('APP_NAME')}}</strong>, we are a team of passionate innovators
                dedicated to transforming the way healthcare services are accessed and managed. Our platform bridges the
                gap between patients and healthcare professionals, ensuring convenience, transparency, and reliability
                every step of the way.</p>

            <h2 class="text-2xl font-semibold text-blue-500 mb-3">Our Vision</h2>
            <p class="mb-6">We envision a world where booking healthcare appointments is as simple as clicking a button.
                By leveraging cutting-edge technology, we aim to eliminate barriers to healthcare access and create a
                platform that prioritizes patient well-being above all.</p>

            <h2 class="text-2xl font-semibold text-blue-500 mb-3">What We Offer</h2>
            <ul class="list-disc pl-6 mb-6">
                <li class="mb-2"><strong>Comprehensive Healthcare Provider Listings:</strong> Search and choose from a
                    wide range of healthcare professionals, including general practitioners, specialists, therapists,
                    and more.
                </li>
                <li class="mb-2"><strong>Easy Appointment Booking:</strong> Schedule appointments effortlessly based on
                    your availability and preferred location.
                </li>
                <li class="mb-2"><strong>Personalized Profiles:</strong> Access detailed profiles, reviews, and
                    credentials of healthcare providers to make informed decisions.
                </li>
                <li class="mb-2"><strong>Secure Communication:</strong> Communicate directly with your healthcare
                    provider while maintaining the highest levels of data privacy and security.
                </li>
                <li class="mb-2"><strong>Flexible Rescheduling:</strong> Modify or cancel appointments with ease to suit
                    your changing schedule.
                </li>
            </ul>

            <h2 class="text-2xl font-semibold text-blue-500 mb-3">Why Choose Us?</h2>
            <ul class="list-disc pl-6 mb-6">
                <li class="mb-2"><strong>User-Friendly Interface:</strong> Our platform is designed to be intuitive and
                    accessible for users of all ages and technical backgrounds.
                </li>
                <li class="mb-2"><strong>Verified Professionals:</strong> We ensure all listed healthcare providers meet
                    stringent qualification and credential checks.
                </li>
                <li class="mb-2"><strong>24/7 Support:</strong> Our dedicated support team is available round the clock
                    to assist you with any queries or concerns.
                </li>
                <li class="mb-2"><strong>Innovative Technology:</strong> We continuously upgrade our system to integrate
                    the latest advancements, ensuring a smooth and efficient experience.
                </li>
            </ul>

            <h2 class="text-2xl font-semibold text-blue-500 mb-3">Our Commitment</h2>
            <p class="mb-6">Your health is our priority. At <strong>{{env('APP_NAME')}}</strong>, we are
                committed to making healthcare more accessible and convenient for everyone. By providing a reliable and
                efficient booking platform, we strive to simplify your journey to better health.</p>

            <h2 class="text-2xl font-semibold text-blue-500 mb-3">Get in Touch</h2>
            <p class="mb-4">Have questions or feedback? Contact us at <a href="mailto:[info@mail.com]"
                                                                         class="text-blue-600 underline">info@mail.com
                </a> or call us at
                <a href="tel:[98798787]" class="text-blue-600 underline">98798787</a>. We’d love to hear from you and assist you in any way we can.</p>

            <p>Thank you for choosing <strong>{{env('APP_NAME')}}</strong>. Together, let’s make healthcare
                simpler and more accessible for all.</p>
        </div>
    </div>

    <script>
        const MONTH_NAMES =
            ['January', 'February', 'March',
                'April', 'May', 'June',
                'July', 'August', 'September',
                'October', 'November', 'December']
        const DAYS = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat']

        function app() {
            return {
                showDatepicker: false,
                datepickerValue: '',

                month: '',
                year: '',
                no_of_days: [],
                blankdays: [],
                days: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],

                initDate() {
                    let today = new Date()
                    this.month = today.getMonth()
                    this.year = today.getFullYear()
                    this.datepickerValue =
                        new Date(this.year,
                            this.month,
                            today.getDate()).toDateString()
                },

                isToday(date) {
                    const today = new Date()
                    const d = new Date(this.year, this.month, date)
                    return today.toDateString() === d.toDateString() ? true : false
                },

                getDateValue(date) {
                    let selectedDate = new Date(this.year, this.month, date)
                    this.datepickerValue = selectedDate.toDateString()
                    this.$refs.date.value =
                        selectedDate.getFullYear()
                        + "-"
                        + ('0'
                            + selectedDate.getMonth()).slice(-2)
                        + "-"
                        + ('0'
                            + selectedDate.getDate()).slice(-2)
                    console.log(this.$refs.date.value)
                    this.showDatepicker = false
                },

                getNoOfDays() {
                    let daysInMonth = new Date(this.year, this.month + 1, 0).getDate()

                    // find where to start calendar day of week
                    let dayOfWeek = new Date(this.year, this.month).getDay()
                    let blankdaysArray = []
                    for (var i = 1; i <= dayOfWeek; i++) {
                        blankdaysArray.push(i)
                    }

                    let daysArray = []
                    for (var i = 1; i <= daysInMonth; i++) {
                        daysArray.push(i)
                    }

                    this.blankdays = blankdaysArray
                    this.no_of_days = daysArray
                }
            }
        }
    </script>
</x-guest-layout>