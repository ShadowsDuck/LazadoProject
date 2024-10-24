<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
        rel="stylesheet">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cart Page</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css"
            rel="stylesheet">
        <style>
            body {
                margin: 0;
                padding: 0;
                font-family: 'Helvetica Neue', sans-serif;
                background-color: #f8f9fa;
            }

            .table {
                width: 100%;
                table-layout: fixed;
            }

            /* Header row */
            .header-row {
                display: grid;
                grid-template-columns: 50px 1fr 1fr 1fr 1fr 50px;
                align-items: center;
                padding: 15px 0;
                font-weight: bold;
                background-color: white;
                border-bottom: 1px solid #e0e0e0;
            }

            .header-row div {
                text-align: center;
            }

            /* Cart item box */
            .cart-item-box {
                display: grid;
                grid-template-columns: 50px 1fr 1fr 1fr 1fr 50px;
                align-items: center;
                background-color: white;
                border: 1px solid #e0e0e0;
                border-radius: 8px;
                padding: 15px;
                margin-bottom: 20px;
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
            }

            .cart-item-details {
                display: flex;
                align-items: center;
                gap: 15px;
            }

            .cart-item-image {
                width: 80px;
                height: 80px;
                overflow: hidden;
                border-radius: 8px;
            }

            .cart-item-image img {
                width: 100%;
                height: 100%;
                object-fit: cover;
            }

            .cart-item-info {
                font-size: 1rem;
                font-weight: 600;
                color: #343a40;
                text-align: left;
            }

            .cart-item-price,
            .cart-item-total {
                font-size: 1.1rem;
                font-weight: bold;
                color: #007bff;
                text-align: center;
            }

            .cart-item-quantity {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .cart-item-quantity input {
                width: 40px;
                height: 35px;
                text-align: center;
                border: 1px solid #ddd;
                border-radius: 5px;
            }

            .remove-btn {
                color: red;
                font-size: 1.2rem;
                cursor: pointer;
                text-align: center;
            }

            .total-section {
                display: flex;
                justify-content: flex-end;
                align-items: center;
                font-weight: bold;
                margin-top: 30px;
            }

            .total-section span {
                font-size: 1.3rem;
            }

            .checkout-btn {
                background-color: #007bff;
                color: white;
                padding: 10px 20px;
                border: none;
                border-radius: 5px;
                transition: background-color 0.3s ease;
            }

            .checkout-btn:hover {
                background-color: #0056b3;
            }

            footer {
                background-color: #343a40;
                color: white;
                padding: 40px 0;
            }

            footer h5 {
                font-size: 1.2rem;
                margin-bottom: 20px;
            }

            footer a {
                color: white;
                text-decoration: none;
            }

            footer a:hover {
                text-decoration: underline;
            }
        </style>


<script>
    window.onload = function() {
        const selectAll = document.getElementById('select-all');
        let itemCheckboxes = document.querySelectorAll('.item-checkbox');

        selectAll.addEventListener('change', function() {
            itemCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            calculateSummary();
        });

        itemCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', calculateSummary);
        });

        const minusButtons = document.querySelectorAll('.minus-btn');
        const plusButtons = document.querySelectorAll('.plus-btn');
        let removeButtons = document.querySelectorAll('.remove-btn');

        minusButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.nextElementSibling;
                if (input.value > 1) {
                    input.value--;
                    updateTotalPrice(input);
                }
                calculateSummary();
            });
        });

        plusButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const input = this.previousElementSibling;
                input.value++;
                updateTotalPrice(input);
                calculateSummary();
            });
        });

        removeButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm("แน่ใจหรือไม่ว่าต้องการลบสินค้านี้?")) {
                    const row = this.closest('.cart-item-box');
                    row.remove();

                    // อัปเดตรายการ itemCheckboxes ใหม่หลังจากลบสินค้า
                    itemCheckboxes = document.querySelectorAll('.item-checkbox');

                    // คำนวณราคารวมใหม่
                    calculateSummary();
                }
            });
        });

        function updateTotalPrice(input) {
            const row = input.closest('.cart-item-box');
            const price = parseFloat(row.querySelector('.cart-item-price').textContent.replace('฿', '').replace(',', ''));
            const totalPriceElement = row.querySelector('.cart-item-total');
            const totalPrice = price * input.value;
            totalPriceElement.textContent = `฿${totalPrice.toLocaleString()}`;
        }

        function calculateSummary() {
            let totalItems = 0;
            let totalPrice = 0;

            itemCheckboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    const row = checkbox.closest('.cart-item-box');
                    const quantity = parseInt(row.querySelector('.cart-item-quantity input').value);
                    const pricePerItem = parseFloat(row.querySelector('.cart-item-price').textContent.replace('฿', '').replace(',', ''));
                    totalItems += quantity;
                    totalPrice += pricePerItem * quantity;
                }
            });

            document.getElementById('selected-count').textContent = totalItems;
            document.getElementById('total-price').textContent = `฿${totalPrice.toLocaleString()}`;
        }
    };
</script>

    </head>

<body>
    <!-- Header -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
        <div class="container mt-4">
            <a class="navbar-brand fw-bold fs-3" href="#">Lazado</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link active" href="#">หน้าแรก</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="#">ติดต่อเรา</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="#">เกี่ยวกับเรา</a>
                    </li>
                    <li class="nav-item me-4 fs-6">
                        <a class="nav-link" href="#">สมัครสมาชิก</a>
                    </li>
                </ul>
                <div class="d-flex">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="ค้นหาสินค้า" aria-label="Search">
                        <span class="input-group-text">
                            <i class="bi bi-search col-md-auto"></i>
                        </span>
                    </div>
                    <a href="#" class="ms-4 mt-1"><i style="color:black;" class="bi bi-cart3 h4"></i></a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Cart Section -->
    <div class="container mt-4">
        <h4>ตะกร้าสินค้า</h4>

        <!-- Invisible Column Headers -->
        <div class="header-row">
            <div><input type="checkbox" id="select-all"> </div>
            <div>สินค้า</div>
            <div>ราคา</div>
            <div>จำนวน</div>
            <div>ยอดรวม</div>
            <div></div>
        </div>

        <!-- Cart Items -->
        <div class="cart-item-box">
    <input type="checkbox" class="item-checkbox">
    <div class="cart-item-details">
        <div class="cart-item-image">
            <img src="https://resource.logitechg.com/w_692,c_lpad,ar_4:3,q_auto,f_auto,dpr_1.0/d_transparent.gif/content/dam/gaming/en/non-braid/hyjal-g502-hero/g502-hero-gallery-2-nb.png?v=1" alt="Logitech G502">
        </div>
        <div class="cart-item-info">Logitech G502 HERO</div>
    </div>
    <div class="cart-item-price">฿2,400</div>
    <div class="cart-item-quantity">
        <button class="minus-btn">-</button>
        <input type="number" value="1" min="1">
        <button class="plus-btn">+</button>
    </div>
    <div class="cart-item-total">฿2,400</div>
    <div class="remove-btn"><i class="bi bi-trash"></i></div>
</div>

<div class="cart-item-box">
    <input type="checkbox" class="item-checkbox">
    <div class="cart-item-details">
        <div class="cart-item-image">
            <img src="https://storage.googleapis.com/file-computeandmore/images/fec5af6a-02b0-4f28-af85-e3c56843f9b2.jpg" alt="Razer BlackWidow">
        </div>
        <div class="cart-item-info">Razer BlackWidow V3</div>
    </div>
    <div class="cart-item-price">฿4,200</div>
    <div class="cart-item-quantity">
        <button class="minus-btn">-</button>
        <input type="number" value="1" min="1">
        <button class="plus-btn">+</button>
    </div>
    <div class="cart-item-total">฿4,200</div>
    <div class="remove-btn"><i class="bi bi-trash"></i></div>
</div>
<div class="cart-item-box">
    <input type="checkbox" class="item-checkbox">
    <div class="cart-item-details">
        <div class="cart-item-image">
            <img src="data:image/jpeg;base64,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" alt="Corsair Void">
        </div>
        <div class="cart-item-info">Corsair Void Elite RGB</div>
    </div>
    <div class="cart-item-price">฿3,000</div>
    <div class="cart-item-quantity">
        <button class="minus-btn">-</button>
        <input type="number" value="1" min="1">
        <button class="plus-btn">+</button>
    </div>
    <div class="cart-item-total">฿3,000</div>
    <div class="remove-btn"><i class="bi bi-trash"></i></div>
</div>

<div class="cart-item-box">
    <input type="checkbox" class="item-checkbox">
    <div class="cart-item-details">
        <div class="cart-item-image">
            <img src="https://m.media-amazon.com/images/I/81AS1wzLGXL.jpg" alt="Asus ROG Strix">
        </div>
        <div class="cart-item-info">Asus ROG Strix Scar III</div>
    </div>
    <div class="cart-item-price">฿39,000</div>
    <div class="cart-item-quantity">
        <button class="minus-btn">-</button>
        <input type="number" value="1" min="1">
        <button class="plus-btn">+</button>
    </div>
    <div class="cart-item-total">฿39,000</div>
    <div class="remove-btn"><i class="bi bi-trash"></i></div>
</div>

<div class="cart-item-box">
    <input type="checkbox" class="item-checkbox">
    <div class="cart-item-details">
        <div class="cart-item-image">
            <img src="data:image/jpeg;base64,/9j/4AAQSkZJRgABAQAAAQABAAD/2wCEAAkGBxMTEhUQExMVEBMWExAQFRERFxMZFRUYFhcXFhUVGBUYHSggGRomHxMWITEiJSkrLi4uFx81ODMtOCgtLi0BCgoKDg0OGxAQGy0mHx4vLTcvLS0vKy0rNzUtLS0rLSsyKystLS0tLy0tLSsrKy8sKy0rLTcrMC0rLy0tNS0tK//AABEIAOEA4QMBIgACEQEDEQH/xAAcAAEAAgMBAQEAAAAAAAAAAAAABgcDBAUIAgH/xABDEAACAQIDBAcEBwYDCQAAAAAAAQIDEQQFIQYSMUEHEyJRYXGBMpGxwUJSYqHR4fAUI2NygpIXovEVJDM0U1RzssL/xAAZAQEBAQEBAQAAAAAAAAAAAAAAAQIDBAX/xAAhEQEBAAIBBAIDAAAAAAAAAAAAAQIRAxIhMUEEIlFx4f/aAAwDAQACEQMRAD8AvEAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA08zzOnQjvTer4RXtS8l8zDnmbRw8L+1N+zH5vwKh2r2q6tuUn1laXJ8u665LuRvj48s7qJllMZupbnm20oq7mqEeSjrJ+r+ViGY7pE306bdWcfCpUjL0lCUXF+TK7x+YTqycpycmzFRuz6nH8Pjxn2715MufK3suKjtJi8JSpYulXnjMDW0SxVpVaM7tOnOotXZpq/hz5zDJtvsNWsql8PP7esPSa+aRAejyH7Rl2OwMtbJVoX5OUXw9aSfqQ/CYl7qb42V18T5vLh053F6sLubemadRSSlFqSeqad0/Jo+igcm2jrYd3pVHDW7j9F+ceD+Jb+x+0sMbScrKNWFlUgvHhJfZdn7mvE56ad8AEAAAAAAAAAAAAAAAAAAAAAAAAAxYrEKEXN8F9/gZSDba5/GMZdq0Yp6+XF/JFk2Itt1tNub027zd1CP5dyKjr1pVJOcndvVtm1nOZSr1JVZaLhFdy5JeP5nLqVL+C7j6PVj8bHpnfK+Xm1eW79Mu/Ffa+5GSliF3W8Vf4M0z6R5b8jkt31V2nHjPS2+inNaX7+mqco1VRUpybUlNXsrPilrwtz4sgmGq/vnTesXVqxtfubsd7oq9rEy7qUIe+Ta+BEo1v37l/Eqy98vzOeWVyu61JJNRKKuWyWsHveHP8AH4+Z2ejvMpUMwpxd0qqnRfc9N6Pg3vRS9WZctyh7tOdapHDRk5aykpupFJS34KCaUUmrtv3HIzmrUpau9OrTanGcWr6RcoyjJcVommtDKvRCfM/TFhJXgn4GUyAAAAAAAAAAAAAAAAAAAAAAAAOZn2O6unZO0pXS8F9J/rvKD6QM735ujF9lWcv/AJXz9UT3bfaNfvKl+yk4Q8lpdeb+JR2MxDnJyerbbfmz0cNmE6768fv+Oef2+rDUnf5I+QfqOVtt3W5NP1InHRx0e1Mwl11RulhIyalUXtVWnrCnf3OXLgteGt0bbGSzHEWleOGpWdaa0bvwpRf1nzfJa8Wj0phMNClCNKnFU4QioRhFWjGKVkku4yqG7TZdQwmHjSoU40YQp1HaK8tW+Lbs229TzthXebfr73f5F/dLVZwwted9OrVJec3ur/3PP0dNVoywTjZfPo0kqVSTpqMpzp1VFyUd9JVITjFqThLdi7xaacVyuj52rzClUVKlSn1rjCvGVVQcIt1HUmoQi9VGO80vBkRp4vvXr+vzOtktPra1GC13q1GH904xa892Un6AensD7CNgw4P2F6/FmYyAAAAAAAAAAAAAAAAAAAAAAcXa/Mepw0mnaU/3Uf6uL9En9x2iuukXETnUjFLsQUorVK83Zzt5LdRYKo23zK7jST+0/gvm/cRA2cxxLqVJTfNv8EaxvO+vwknt+m3lOW1MTWp4ejHeqVJKEVyvzbfJJXbfcmahd3QRstuU5ZlUj2ql6VBPlBPtz/qkreUftGFWNsrkFPA4anhaWqirynznN+3N+LfuVlyOsD5qSsm+5NkEVz+hRxMauFrx36c2k1dp6NSi01qmmk/QrXPOiKorzwVZVVx6mvaM/KNRLdfk1HzJ7iO1WS1V5frgSuOEaitxpafST19b6FHlTNMrr4afV4ijOhLkqisn/LL2ZejZJeirL3WzGm0rqlGpXlb7K3Y/5pxL7x2E34OnWoRrU3pKLUZwa8Yy1fuNDZfZfCYWdSeGoui6lt9PrLJJ3tFT9la8FoNiS0I2il4I+wCAAAAAAAAAAAAAAAAAAAAAA/Jysmyk+lfOJU7xhZ69RvX4OSlKpNLm96/6RcuOq7sJS7k37tfkea+lLEWxjw921CMajburyqLefHikmtVzbLBEUgfiZ9Io6Gz2UTxeJpYWF71JqLa+jHjKXpFNnqWpisNgaMKcpwoU6cIwhFvXdirKy4vgUL0f4iWDUsTGm6mJrqOHwsEk5Ped5SjHx3Y2b0SjJ8Cxsq2M3pftOYy/aq8rS6ltuhS8Hf8A4svF6dy5kHS/xKw83bDUMTjFqt+jS/d6fxJNJG1g9rXWvCeErYVOLanVlh3HlpaFRyu/IYvEwjaOncox4LwSXyNLdUvo+92+FwM+Dt1vWaO2pJMNmMZOz7JGaOWrkrfyzkvlY3sNDdtGSduCukpejXZl5aMCTA5dDF7jUZO8Xfdl5cfdzXI6iZAAAAAAAAAAAAAAAAAAAAAAAABo51C9GS71Yi2LjhJUGsaqTpL/AK6jKN/sp638tTa272sp4Sm4q0qlr25R7r+PgeeM7zytiajlOTavpHkiwd3aXAZNKTeEr16Er+z1cqlB+W+1Uj/m8jjZJk95SrVnH9npdqck9JtaqCvZpPi7paeZrYHCSqTjTiryk1Ffi/Di/Qs/YrIIV6yja+Ewkk3fhXxHtJPvUdJNfyLhoUSXYPZ+VNft2IjavVjalTa/5ei+EbcpyVm+5WXJ36+a4936uHHm+79febWa43cXfJ6Jfr9cTiUod+rerfeyD6o0fzb4s3aVJI+KaNiJRmpuxu0aia3ZJNPR34eqNGJmgyD7x2E7PV71oyt1dTi6dRexd81y8U2nxR97MZn1tPdkt2cHKE4fVnB7s4+jWnemjZoxU4Om+DXqvFeK4kXy2u6WYzi9OupQrtfxKb6itZd3Zg/UCcgAgAAAAAAAAAAAAAAAAAAAcvaLNFh6Ln9J6Rv39/odQqvpPzrtuCekU4rz5v3/AALBWm3GbupNptttttvm2R/B076mti6jnUbfebcezDz0/E3jj1XSW6dnZ+puRr4q19yHVU1xblPi/OyS/rZe2zOVrCYOlQ+lGG/Vl9apPt1Jf3N+iRSuzNFSp4alyqZhRUvFKUPlEvPN69oSfn+PyLyyTKyGPhxq9Zzm5PhdpfN/L08TNSia1KNkl3KxtwMKyxMsTFEyRIM0TLExRMkQN/AvVGnictc66qRUXuVKibftJTp03ZPuum2vI3MAtTay/Xfn9apJryjaCfujf1A2gAQAAAAAAAAAAAAAAAAAAB+SZ532+xLdaV+Oj9+vzPQ1Z6HnvpMwrhWb5PeXrF2+Dj7ywVxOdpnTqu8Ivz+X4HIxfG50MtrKUXB8+HnyOnFl05yplNxaHRhs7Grh44qrJxjTxDnRUWleUN28pN8lJWtzsyc4+UkpwcnJNSnG9tNNUmlw1+JVmx+1MKNF4LEJOm5Scd6O9DtO8oSjrz1va2pN8tzSnKEFR3epjPctTXYi3o42XB9u9vE1zY2Z2/lMfDqQZysJnU6XZxa3ZPeknTSaSVlaybk7t2Vk3prbRvoQ07Pdp6cn7jLiMNCrB06kVOLVmmcmm9CSeq1XeuDMsSL9RWwst6EpVaF3KUHa8buV7XentXutHa7tbtd3L8fCrFSg3wTakmmvO/60A6MWZoIwQN3DxSW9LSK1bZBn1jHdj7c+zHw75ei19x0qNNRiorgkkvQ1cBSbbqyVm9Ip/Rj+L4v8jdIAAAAAAAAAAAAAAAAAAAAADFiV2X5XKs6SMn6+m5RV5e0vGSXD1WnmkWwRXaDBbrenYlw8H3Fg8tYqOpr0qriyxdv9k5JyxNFX4yqQX3zivivUrmcQO1SrxqLV2lw3vxJBshn08JVe+nKjPdVTd14aRqpfWXBrmu9pEFp1HE6GHx3ib67Zqppf1LEQqpShJS0Ti09JReq17nyZkpVrafdzRT+z+0s8O+zaULtunLhrxaf0W/8AVMsLIdqaOLnGhGM+uldKm4tvRXdpx5ac7GVSmnWXeadfKoyqKrTk6U7wTcecY6aW5201utOBs/7Oq3t1dVecG170dDCZNWfLdXfKy+67f3EGalbi3ZHRweHdRqUlu007qL4ya4Nru8P0o1X2ezGrV6tzpYXDp9qrSnKpiJx5qF4KNNtXV1qu9k6pwUUorRJJJeC0QH0ACAAAAAAAAAAAAAAAAAAAAAAGLE0Izi4SV0/1deJlAEFzrKpUnqt6HKa+D7mVttLsLCq3UotUpu7cbdiXovZfivcegpxTVmk09GnwZFc92FoYhqUZVKEle3VyaWvhy9C7SvNGY7PYii3v0pJfWSvH+5aHPVA9QrZOovpU5JaXk5X9eyzdhsw1CSjUjRqNdmpTpU24vv7S1+4dleetmdhsZi5JUqUlF69bUvGml37z48fo34l77JbJYbKKE60pb1TcvVxDT9la7sIq7Ub8lq3bwS7Oz2QLDb051amJrTsp16vGyvaEYrSMVduy7z423f8AuOI/8fzQ2OR/illfOvUj/Nh8UvjTMkek7Kf+8gv5o1V8YlC43ESbdp+l3+JzJVZ31l97IPU2R7TYTGbyw2Ip13GzkoPVJ8G09beJ1ikegau3Xcb6dRXdr6X65a/eXcAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAGnmWW0q1OVOpShVjJawnGLTtqtH4pHLy3Y/A0pOccHQhJrdv1ceGjtZ6cUiQADUweV0KT3qVGlSbVm6cIRbXG14o2wAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAP//Z" alt="SteelSeries Arctis">
        </div>
        <div class="cart-item-info">SteelSeries Arctis 7</div>
    </div>
    <div class="cart-item-price">฿5,500</div>
    <div class="cart-item-quantity">
        <button class="minus-btn">-</button>
        <input type="number" value="1" min="1">
        <button class="plus-btn">+</button>
    </div>
    <div class="cart-item-total">฿5,500</div>
    <div class="remove-btn"><i class="bi bi-trash"></i></div>
</div>

<div class="cart-item-box">
    <input type="checkbox" class="item-checkbox">
    <div class="cart-item-details">
        <div class="cart-item-image">
            <img src="https://example.com/benq-zowie.jpg" alt="BenQ Zowie">
        </div>
        <div class="cart-item-info">BenQ Zowie XL2411P</div>
    </div>
    <div class="cart-item-price">฿10,000</div>
    <div class="cart-item-quantity">
        <button class="minus-btn">-</button>
        <input type="number" value="1" min="1">
        <button class="plus-btn">+</button>
    </div>
    <div class="cart-item-total">฿10,000</div>
    <div class="remove-btn"><i class="bi bi-trash"></i></div>
</div>

<div class="cart-item-box">
    <input type="checkbox" class="item-checkbox">
    <div class="cart-item-details">
        <div class="cart-item-image">
            <img src="https://example.com/razer-naga.jpg" alt="Razer Naga">
        </div>
        <div class="cart-item-info">Razer Naga X</div>
    </div>
    <div class="cart-item-price">฿2,200</div>
    <div class="cart-item-quantity">
        <button class="minus-btn">-</button>
        <input type="number" value="1" min="1">
        <button class="plus-btn">+</button>
    </div>
    <div class="cart-item-total">฿2,200</div>
    <div class="remove-btn"><i class="bi bi-trash"></i></div>
</div>

<div class="cart-item-box">
    <input type="checkbox" class="item-checkbox">
    <div class="cart-item-details">
        <div class="cart-item-image">
            <img src="https://example.com/razer-kraken.jpg" alt="Razer Kraken">
        </div>
        <div class="cart-item-info">Razer Kraken X</div>
    </div>
    <div class="cart-item-price">฿2,000</div>
    <div class="cart-item-quantity">
        <button class="minus-btn">-</button>
        <input type="number" value="1" min="1">
        <button class="plus-btn">+</button>
    </div>
    <div class="cart-item-total">฿2,000</div>
    <div class="remove-btn"><i class="bi bi-trash"></i></div>
</div>

<div class="cart-item-box">
    <input type="checkbox" class="item-checkbox">
    <div class="cart-item-details">
        <div class="cart-item-image">
            <img src="https://example.com/coolermaster-mousepad.jpg" alt="Cooler Master Mousepad">
        </div>
        <div class="cart-item-info">Cooler Master MP510</div>
    </div>
    <div class="cart-item-price">฿1,200</div>
    <div class="cart-item-quantity">
        <button class="minus-btn">-</button>
        <input type="number" value="1" min="1">
        <button class="plus-btn">+</button>
    </div>
    <div class="cart-item-total">฿1,200</div>
    <div class="remove-btn"><i class="bi bi-trash"></i></div>
</div>

<div class="cart-item-box">
    <input type="checkbox" class="item-checkbox">
    <div class="cart-item-details">
        <div class="cart-item-image">
            <img src="https://example.com/acer-monitor.jpg" alt="Acer Monitor">
        </div>
        <div class="cart-item-info">Acer Predator X27</div>
    </div>
    <div class="cart-item-price">฿45,000</div>
    <div class="cart-item-quantity">
        <button class="minus-btn">-</button>
        <input type="number" value="1" min="1">
        <button class="plus-btn">+</button>
    </div>
    <div class="cart-item-total">฿45,000</div>
    <div class="remove-btn"><i class="bi bi-trash"></i></div>
</div>
        
        <br>

        <!-- Total Section -->
        <div class="total-section">
            <span>เลือกแล้ว <span id="selected-count">0</span> ชิ้น</span>&nbsp;&nbsp;&nbsp;&nbsp;
            <span>ราคารวม: <span id="total-price">฿0</span></span>
            <button class="checkout-btn ms-4">สั่งซื้อ</button>
        </div><br><br><br>




        <!-- Footer -->

    </div>
    <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-3">
                    <h5>Exclusive</h5>
                    <p>Get 10% off your first order</p>
                </div>
                <div class="col-md-3">
                    <h5>Support</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">FAQ</a></li>
                        <li><a href="#" class="text-white">Contact Us</a></li>
                    </ul>
                </div>
                <!-- เพิ่มเนื้อหาส่วนท้ายเพิ่มเติมได้ที่นี่ -->
            </div>
        </div>
    </footer>


</body>

</html>