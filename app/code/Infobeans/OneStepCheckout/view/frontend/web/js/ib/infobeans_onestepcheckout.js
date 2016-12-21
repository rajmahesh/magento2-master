define([
        'jquery',
        'Magento_Ui/js/modal/modal',
        'jquery/ui',
        'jquery/validate',
        'Infobeans_OneStepCheckout/js/ib/plugins/jquery.nicescroll.min'
    ],
    function ($, modal) {
        'use strict';
        $.widget('mage.ibOsc', {
            popup: null,
            init: function () {
                this.showModal();
                this.inputText();
                this.cvvText();
                this.sendForm();
                this.newModal();
            },

            inputText: function () {
                $(document).off('blur', '#authorizenet_directpost_cc_number');
                $(document).on('blur', '#authorizenet_directpost_cc_number', function (e) {

                    if ($('#authorizenet_directpost_cc_number').val() == 0) {
                        $(this).closest('div.number').find('label').removeClass('focus');
                    }
                });

                $(document).off('focus', '#authorizenet_directpost_cc_number');
                $(document).on('focus', '#authorizenet_directpost_cc_number', function (e) {

                    $(this).closest('div.number').find('label').addClass('focus');


                });
            },
            cvvText: function () {
                $(document).off('blur', '#authorizenet_directpost_cc_cid');
                $(document).on('blur', '#authorizenet_directpost_cc_cid', function (e) {

                    if ($('#authorizenet_directpost_cc_cid').val() == 0) {
                        $(this).closest('div.cvv').find('label').removeClass('focus');
                    }
                });

                $(document).off('focus', '#authorizenet_directpost_cc_cid');
                $(document).on('focus', '#authorizenet_directpost_cc_cid', function (e) {

                    $(this).closest('div.cvv').find('label').addClass('focus');


                });
            },
            showModal: function () {
                var _self = this;
                $(document).off('click touchstart', '.actions-toolbar .remind');
                $(document).on('click touchstart', '.actions-toolbar .remind', function (e) {
                    e.preventDefault();
                    $('.ib-osc-forgot-response-message').hide();
                    _self.displayModal();
                });
            },

            newModal: function(){
                var _self = this;
                $(document).on('click touchstart', '.actions-toolbar .remind', function (e) {
                    e.preventDefault();
                    _self.reopenModal();
                });
            },

            reopenModal: function () {
                $(".ib-osc-forgot-main-wrapper").modal('openModal');
            },

            displayModal: function () {
                var modalContent = $(".ib-osc-forgot-main-wrapper");
                this.popup = modalContent.modal({
                    autoOpen: true,
                    type: 'popup',
                    modalClass: 'ib-osc-forgot-wrapper',
                    title: '',
                    buttons: [{
                        class: "ib-hidden-button-for-popup",
                        text: 'Back to Login',
                        click: function () {
                            $('.ib-osc-forgot-response-message').hide();
                            this.closeModal();
                        }
                    }]
                });
            },

            sendForm: function(){
                $('.ib-forgot-password-submit').click(function(e){
                    e.preventDefault();
                    var email = $('.ib-osc-forgot-email').val();
                    var validator = $(".ib-osc-forgot-form").validate();
                    var status = validator.form();
                    if (!status) {
                        return;
                    }
                    if (typeof(postUrl) != "undefined") {
                        var sendUrl = postUrl;
                    } else {
                        console.log("IB post url error.");
                    }
                    $.ajax({
                        type: "POST",
                        data: {email: email},
                        url: sendUrl,
                        showLoader: true
                    }).done(function (response) {
                        if(typeof(response.message != "undefined")){
                            $('.ib-osc-forgot-response-message').html(response.message);
                            $('.ib-osc-forgot-email').val('');
                            $('.ib-osc-forgot-response-message').show();
                        }
                    });
                });
            }
        });

        return $.mage.ibOsc;

    });