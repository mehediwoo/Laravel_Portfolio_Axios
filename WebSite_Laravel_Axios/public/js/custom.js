// Owl Carousel Start..................



$(document).ready(function() {
    var one = $("#one");
    var two = $("#two");

    $('#customNextBtn').click(function() {
        one.trigger('next.owl.carousel');
    })
    $('#customPrevBtn').click(function() {
        one.trigger('prev.owl.carousel');
    })
    one.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:2
            },
            1000:{
                items:4
            }
        }
    });

    two.owlCarousel({
        autoplay:true,
        loop:true,
        dot:true,
        autoplayHoverPause:true,
        autoplaySpeed:100,
        margin:10,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:1
            },
            1000:{
                items:1
            }
        }
    });

});

// Owl Carousel End..................

//SendButton
$('#sendBtn').click(function(){
    var name  = $('#name').val();
    var phone = $('#phone').val();
    var mail  = $('#mail').val();
    var desc  = $('#desc').val();
    SendContact(name,phone,mail,desc);
});

//Contact Form Send 
function SendContact(name,phone,mail,desc){

        if (name.length=='') {
            $('#sendBtn').html('আপনার নাম লিখুন');
            setTimeout(function(){
                $('#sendBtn').html('পাঠিয়ে দিন')
            }, 2000);
        }else if(phone.length==''){
            $('#sendBtn').html('আপনার মোবাইল নাম্বার লিখুন');
            setTimeout(function(){
                $('#sendBtn').html('পাঠিয়ে দিন')
            }, 2000);
        }else if(mail.length==''){
            $('#sendBtn').html('আপনার ইমেইল ঠিকানা লিখুন');
            setTimeout(function(){
                $('#sendBtn').html('পাঠিয়ে দিন')
            }, 2000);
        }else if(desc.length=='') {
           $('#sendBtn').html('আপনার মেসেজ লিখুন');
           setTimeout(function(){
                $('#sendBtn').html('পাঠিয়ে দিন')
            }, 2000);
        }
        else{
            axios.post('/contact', {
            name: name,
            phone: phone,
            mail: mail,
            desc: desc
          })
          .then(function (response) {

            if (response.status==200) 
            {
                $('#sendBtn').html('আপনার মেসেজ সফল হয়েছে');
                setTimeout(function(){
                $('#sendBtn').html('পাঠিয়ে দিন')
            }, 2000);
            }else{

                $('#sendBtn').html('আপনার মেসেজ ব্যর্থ হয়েছে');
                setTimeout(function(){
                    $('#sendBtn').html('পাঠিয়ে দিন')
                }, 2000);
            }
          })
          .catch(function (error) {
                 $('#sendBtn').html('আপনার মেসেজ ব্যর্থ হয়েছে');
                setTimeout(function(){
                    $('#sendBtn').html('পাঠিয়ে দিন')
                }, 2000);
          });
        }
}