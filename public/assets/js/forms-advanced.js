"use strict";

$(".currency")
    .toArray()
    .forEach(function (field) {
        new Cleave(field, {
            numeral: true,
            numeralThousandsGroupStyle: "thousand",
        });
    });

$(".phone-number")
    .toArray()
    .forEach(function (field) {
        new Cleave(field, {
            phone: true,
            phoneRegionCode: "id",
        });
    });

$(".select2").select2();
