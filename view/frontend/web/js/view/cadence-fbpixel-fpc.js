/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
define([
    'ko',
    'uiComponent',
    'Magento_Customer/js/customer-data'
], function (ko, Component, customerData) {
    'use strict';
    return Component.extend({
        initialize: function () {
            var self = this;
            self._super();
            //console.log(customerData.get('cadence-fbpixel-fpc')());
            customerData.get('cadence-fbpixel-fpc').subscribe(function(loadedData){
                //console.log(loadedData);
                if (loadedData && "undefined" !== typeof loadedData.events) {
                    for (var eventCounter = 0; eventCounter < loadedData.events.length; eventCounter++) {
                        var eventData = loadedData.events[eventCounter];
                        //console.log(eventData);
                        if ("undefined" !== typeof eventData.eventAdditional && eventData.eventAdditional) {
                            //console.log("Tracking: " + eventData.eventName + " , with data: ");
                            //console.log(eventData.eventAdditional);
                            fbq('track', eventData.eventName, eventData.eventAdditional || {});
                        }
                    }
                    customerData.set('cadence-fbpixel-fpc', {});
                }
            });
        }
    });
});