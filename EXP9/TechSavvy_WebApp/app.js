const initialProducts=[
{id:1,name:"iPhone 15",category:"Smartphones",price:59900,emoji:"📱",rating:4.8,tag:"Bestseller"},
{id:2,name:"Galaxy S24",category:"Smartphones",price:64999,emoji:"📲",rating:4.7},
{id:3,name:"MacBook Air M3",category:"Laptops",price:109900,emoji:"💻",rating:4.9,tag:"Popular"},
{id:4,name:"ASUS Zenbook 14",category:"Laptops",price:82990,emoji:"🖥️",rating:4.6},
{id:5,name:"iPad Air",category:"Tablets",price:59900,emoji:"▣",rating:4.7},
{id:6,name:"Sony WH-1000XM5",category:"Audio",price:24990,emoji:"🎧",rating:4.9,tag:"Top rated"},
{id:7,name:"AirPods Pro",category:"Audio",price:24900,emoji:"🎵",rating:4.8},
{id:8,name:"Galaxy Watch 6",category:"Wearables",price:18999,emoji:"⌚",rating:4.5},
{id:9,name:"Mechanical Keyboard",category:"Accessories",price:4999,emoji:"⌨️",rating:4.6},
{id:10,name:"Portable Speaker",category:"Audio",price:3499,emoji:"🔊",rating:4.4},
{id:11,name:"Wireless Mouse",category:"Accessories",price:1299,emoji:"🖱️",rating:4.3},
{id:12,name:"Fitness Band",category:"Wearables",price:2999,emoji:"⌚",rating:4.2}
];
let products=JSON.parse(localStorage.getItem("ts_products")||"null")||initialProducts;
let cart=JSON.parse(localStorage.getItem("ts_cart")||"[]");
let wishlist=JSON.parse(localStorage.getItem("ts_wishlist")||"[]");
let activeCategory="All";
const categories=[["Smartphones","📱"],["Laptops","💻"],["Tablets","▣"],["Audio","🎧"],["Wearables","⌚"],["Accessories","⌨️"]];
const money=n=>"₹"+Number(n).toLocaleString("en-IN");
const save=()=>{localStorage.setItem("ts_products",JSON.stringify(products));localStorage.setItem("ts_cart",JSON.stringify(cart));localStorage.setItem("ts_wishlist",JSON.stringify(wishlist));};
function toast(msg){let t=document.getElementById("toast");t.textContent=msg;t.classList.add("show");setTimeout(()=>t.classList.remove("show"),2100)}
function renderCategories(){document.getElementById("categoryGrid").innerHTML=categories.map(([c,e])=>`<button class="category-card ${activeCategory===c?"active":""}" onclick="setCategory('${c}')"><div class="category-icon">${e}</div><strong>${c}</strong></button>`).join("");document.getElementById("categoryFilters").innerHTML=["All",...categories.map(x=>x[0])].map(c=>`<button class="filter-pill ${activeCategory===c?"active":""}" onclick="setCategory('${c}')">${c}</button>`).join("")}
function setCategory(c){activeCategory=c;renderCategories();renderProducts();document.getElementById("catalog").scrollIntoView({behavior:"smooth",block:"start"})}
function renderProducts(){let q=document.getElementById("searchInput").value.toLowerCase();let list=products.filter(p=>(activeCategory==="All"||p.category===activeCategory)&&(p.name+" "+p.category).toLowerCase().includes(q));let sort=document.getElementById("sortSelect").value;if(sort==="low")list.sort((a,b)=>a.price-b.price);if(sort==="high")list.sort((a,b)=>b.price-a.price);if(sort==="rating")list.sort((a,b)=>b.rating-a.rating);document.getElementById("resultCount").textContent=`${list.length} products`;document.getElementById("productGrid").innerHTML=list.length?list.map(p=>`<article class="product-card"><div class="product-visual"><span class="product-emoji">${p.emoji||"📦"}</span><button class="wish-btn ${wishlist.includes(p.id)?"saved":""}" onclick="toggleWish(${p.id})">${wishlist.includes(p.id)?"♥":"♡"}</button></div><div class="product-info"><div class="product-category">${p.category}</div><h3>${p.name}</h3><div class="rating">★★★★★ <span>${p.rating||4.5} / 5</span></div><div class="price-row"><span class="price">${money(p.price)}</span><button class="add-btn" onclick="addCart(${p.id})">＋ Add</button></div></div></article>`).join(""):`<div class="empty">No products found. Try another search.</div>`}
function addCart(id){let item=cart.find(x=>x.id===id);if(item)item.qty++;else cart.push({id,qty:1});save();renderCart();toast("Added to your cart")}
function toggleWish(id){wishlist.includes(id)?wishlist=wishlist.filter(x=>x!==id):wishlist.push(id);save();renderProducts();renderWishlist();toast(wishlist.includes(id)?"Saved to wishlist":"Removed from wishlist")}
function renderCart(){document.getElementById("cartCount").textContent=cart.reduce((s,x)=>s+x.qty,0);let el=document.getElementById("cartItems");if(!cart.length){el.innerHTML='<div class="empty">Your cart is waiting for something great. ✨</div>'}else{el.innerHTML=cart.map(x=>{let p=products.find(p=>p.id===x.id);if(!p)return"";return `<div class="cart-item"><div class="mini-emoji">${p.emoji||"📦"}</div><div class="cart-item-info"><strong>${p.name}</strong><small>${money(p.price)} each</small><div class="qty"><button onclick="changeQty(${p.id},-1)">−</button>${x.qty}<button onclick="changeQty(${p.id},1)">＋</button></div></div><button class="remove" onclick="removeCart(${p.id})">Remove</button></div>`}).join("")}let total=cart.reduce((s,x)=>s+(products.find(p=>p.id===x.id)?.price||0)*x.qty,0);document.getElementById("cartTotal").textContent=money(total);document.getElementById("checkoutTotal").textContent=money(total)}
function changeQty(id,d){let x=cart.find(x=>x.id===id);if(x){x.qty+=d;if(x.qty<1)cart=cart.filter(y=>y.id!==id)}save();renderCart()}
function removeCart(id){cart=cart.filter(x=>x.id!==id);save();renderCart();toast("Item removed")}
function renderWishlist(){let el=document.getElementById("wishlistItems"),list=products.filter(p=>wishlist.includes(p.id));el.innerHTML=list.length?list.map(p=>`<div class="cart-item"><div class="mini-emoji">${p.emoji||"📦"}</div><div class="cart-item-info"><strong>${p.name}</strong><small>${money(p.price)}</small><button class="remove" onclick="toggleWish(${p.id})">Remove</button></div><button class="add-btn" onclick="addCart(${p.id})">Add</button></div>`).join(""):'<div class="empty">No saved products yet. Tap ♡ on a product to save it.</div>'}
function openDrawer(id){document.querySelectorAll(".drawer").forEach(d=>d.classList.remove("open"));document.getElementById(id).classList.add("open");document.getElementById("overlay").classList.add("show")}
function closeAll(){document.querySelectorAll(".drawer,.modal").forEach(d=>d.classList.remove("open","show"));document.getElementById("overlay").classList.remove("show")}
document.getElementById("cartNav").onclick=()=>{renderCart();openDrawer("cartDrawer")};
document.getElementById("wishlistNav").onclick=()=>{renderWishlist();openDrawer("wishlistDrawer")};
document.getElementById("overlay").onclick=closeAll;document.querySelectorAll("[data-close]").forEach(b=>b.onclick=closeAll);
document.getElementById("searchInput").addEventListener("input",renderProducts);document.getElementById("sortSelect").onchange=renderProducts;
document.getElementById("checkoutBtn").onclick=()=>{if(!cart.length){toast("Your cart is empty");return}closeAll();document.getElementById("checkoutModal").classList.add("show");document.getElementById("overlay").classList.add("show")};
document.getElementById("checkoutForm").onsubmit=e=>{e.preventDefault();let order="TS"+Date.now().toString().slice(-7);cart=[];save();renderCart();closeAll();toast("Demo order placed! Order ID: "+order)};
document.getElementById("adminLink").onclick=e=>{e.preventDefault();document.getElementById("adminModal").classList.add("show");document.getElementById("overlay").classList.add("show")};
document.getElementById("adminForm").onsubmit=e=>{e.preventDefault();let f=new FormData(e.target);products.unshift({id:Date.now(),name:f.get("name"),category:f.get("category"),price:Number(f.get("price")),emoji:f.get("emoji")||"📦",rating:5});save();renderProducts();renderCategories();closeAll();e.target.reset();toast("Product added to demo catalogue")};
document.getElementById("newsletterForm").onsubmit=e=>{e.preventDefault();e.target.reset();toast("Thanks for subscribing!")};
document.getElementById("loginBtn").onclick=()=>toast("Sign-in is a UI demo in this frontend version");
renderCategories();renderProducts();renderCart();renderWishlist();