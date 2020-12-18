$(function () {
    const Anker_products = [
        {
            img: "dist/img/a08234f35f5fa7e61f9f072c13c42e39.jpg",
            name: "Tai nghe Anker 1",
            price: "1.100.000 đ",
        },
        {
            img: "dist/img/a08234f35f5fa7e61f9f072c13c42e39.jpg",
            name: "Tai nghe Anker 2",
            price: "1.300.000 đ",
        },
        {
            img: "dist/img/a08234f35f5fa7e61f9f072c13c42e39.jpg",
            name: "Tai nghe Anker 3",
            price: "1.200.000 đ",
        },
        {
            img: "dist/img/a08234f35f5fa7e61f9f072c13c42e39.jpg",
            name: "Tai nghe Anker 4",
            price: "1.900.000 đ",
        },
    ];
    const Kind_products = [
        {
            img: "dist/img/b2.jpg",
            name: "Tai nghe Anker 1",
            price: "1.100.000 đ",
        },
        {
            img: "dist/img/b2.jpg",
            name: "Tai nghe Anker 2",
            price: "1.300.000 đ",
        },
        {
            img: "dist/img/b2.jpg",
            name: "Tai nghe Anker 3",
            price: "1.200.000 đ",
        },
        {
            img: "dist/img/b2.jpg",

            name: "Tai nghe Anker 4",
            price: "1.900.000 đ",
        },
    ];
    const User = [
        {
            user_name: "Thien",
            user_password: "thietvt38a",
            user_avatar: "https://www.jbo247.com/wp-content/uploads/2020/06/original-1-7.jpg",
        }
    ]
    $(".brand li").click(function (e) {
        e.preventDefault();
        renderProduct(Anker_products);

    });
    $(".kind li a").click(function (e) {
        e.preventDefault();
        renderProduct(Kind_products);
    });
    $(".user-name ul.dropdown li.sign-up").click(function (e) {
        e.preventDefault();
        $(".right-product .row").empty();
        $(`<div class="sign-up-form">
        <form action="">
            <h3>SIGN UP </h3>
            <label for="name">Your Name:</label>
            <input id="name" type="text" placeholder="Your full name ... ">
            <label for="email">Email:</label>
            <input type="email" placeholder="Your email">
            <label for="password">Password</label>
            <input type="passwod"
                placeholder="your password, min 6 character, include a-z,A-Z, special character..">
            <label for="re-password">Re-password</label>
            <input type="password" placeholder="Re-password">
            <p><button type="submit">Submit</button></p>
        </form>
    </div>`).appendTo(".right-product .row");
    });

    $(".row").on("click", "form p button", function () {
        let name = $("input#name").val();
        if (name == User[0].user_name) {
            $(".user-avatar a").val(`<img src="${User[0].user_avatar}">`);
        }
    });
});
function renderProduct(product) {
    $(".right-product .row").empty();
    product.map((val) => {
        $(`<div class="col12-sm-3">
    <div class="item">
        <a href=""><img src="${val.img}" alt=""></a>
        <div class="content">
            <h3>${val.name}</h3>
            <p>${val.price}</p>
            <button>Add to Cart</button>
        </div>
    </div>
</div>`).appendTo(".right-product .row");
    });
};
