<?php include "sidebar.php"; ?>

<div class="content">

	<?php include "breadcrumbs.php"; ?>

	Կայքը նախատեսված է Ա-ից Բ կետ Երևան քաղաքում հասարակական տրանսպորտով տեղափոխվելու գործընթացն ավելի հարմար դարձնելուն՝ ի շնորհիվ նախապլանավորման:<br />
	<strong>Բոլոր տեղեկությունները վերցված են <a href="http://www.yerevan.am/">Երևանի քաղաքապետարանի պաշտոնական կայք</a>ից և թարմացվում են կամավորների օգնությամբ՝ հետևաբար marshrut.info կայքը պատասխանատվություն չի կրում դրանց արդիականության և ճշտության համար: Որևէ երթուղուց առաջին անգամ օգտվելիս ճշտեք վարորդից վերջնակետին հասնելու կամ չհասնելու հանգամանքը:</strong><br /><br />
	<blockquote>
		<small>Նպատակը</small>
		<p>Համակարգել տրանսպորտի աշխատանքը Երևանում, ապա նաև ողջ Հայաստանի տարածքում:</p>
	</blockquote>
	<blockquote>
		<small>Ապագան</small>
		<p>Կայքն ստեղծվել և շահագործվում է կամավորական սկզբունքով, հետևաբար, ցանկացած ներդրումն ուղղված կայքի զարգացմանը շատ ողջունելի է:<br />
		Համագործակցության, օգնության և այլ հարցերի համար. <a href="mailto:marshrutinfo@gmail.com?Subject=Համագործակցություն/օգնություն..." target="_blank">marshrutinfo@gmail.com</a></p>
	</blockquote>
	<blockquote>
		<small>Պատմությունը</small>
		<p>Կայքի գաղափարը <a href="https://www.facebook.com/mesrop.minasyan">Մեսրոպ Մինասյան</a>ի կողմից կյանքի է կոչվել 2006 թվականին՝ 15 տարեկանում: Զարգացման հետագա տարբեր փուլեր անցնելով կայքը դարձել է հանրաճանաչ և աշխատել մինչև 2012 թվականի աշունը: Տրանսպորտային նոր ցանցի և համարների փոփոխության հետ կապված փորձ էր կատարվել արդիականացնել կայքը, բայց որոշ հանգամանքների պատճառով այն դարձավ անաշխատունակ: Կայքի վերագործարկման աշխատանքներն Արթուր Տեր-Գրիգորյանն սկսել էր 2012 թ-ի դեկտեմբերից՝ 15 տարեկանում: Նորացված փորձնական տարբերակը հասանելի էր 2013թ. հուլիս ամսից մինչ հոկտեմբերի սկիզբ: Արդի նոր տարբերակը հասանելի է ի շնորհիվ Գևորգ Հարությունյանի:
		</p>
	</blockquote>

	<h3>Մեր թիմը</h3>
	<hr>
	<div class="row">
		<div class="col-md-6">
			<?php
			$silhouette = file_get_contents('https://graph.facebook.com/v2.5/100002335685094/picture?fields=is_silhouette&redirect=false');
			$silhouette = explode(":", $silhouette);
			$silhouette = explode("}", $silhouette[2]);
			if ($silhouette[0] == 'true') {
				$img = 'https://fbcdn-sphotos-h-a.akamaihd.net/hphotos-ak-xpf1/v/t1.0-9/12027587_919368371484344_3731265634628150502_n.jpg?oh=0fad37004a62979e01debc040ed6b2df&oe=56CD8F23&__gda__=1452937289_8f56e7784f22b93bec51e98bb21bcced';
			} else {
				$img = 'https://graph.facebook.com/v2.5/100002335685094/picture?width=160&height=160';
			}
			?>
			<div class="tc">
				<a href="https://facebook.com/ArturTeryan">
					<img style="width: 160px; height: 160px;" src="<?= $img ?>" class="img-circle">
				</a>
				<h2>Արթուր Տեր-Գրիգորյան</h2>
				<h5>Նախաձեռնող, կրտսեր ծրագրավորող</h5>
			</div>
	 	</div>
	 	<div class="col-md-6">
			<?php
			$silhouette = file_get_contents('https://graph.facebook.com/v2.5/1237816620/picture?fields=is_silhouette&redirect=false');
			$silhouette = explode(":", $silhouette);
			$silhouette = explode("}", $silhouette[2]);
			if ($silhouette[0] == 'true') {
				$img = 'https://fbcdn-sphotos-g-a.akamaihd.net/hphotos-ak-xfp1/v/t1.0-9/960035_1403588943208914_720615826_n.jpg?oh=a33a091359f3cc6a159c94576d2d1e05&oe=56891ABE&__gda__=1452592479_8eb392cc39854edcb2999354462543ab';
			} else {
				$img = 'https://graph.facebook.com/v2.5/1237816620/picture?width=160&height=160';
			}
			?>
			<div class="tc">
				<a href="https://facebook.com/madextreme">
					<img style="width: 160px; height: 160px;" src="<?= $img ?>" class="img-circle">
				</a>
				<h2>Գևորգ Հարությունյան</h2>
				<h5>Ավագ ծրագրավորող</h5>
			</div>
		</div>
	 	<!-- <div class="col-md-4">
			<?php /*
	 			$img = retImg(array(
	 				'width' => 160,
					'height' => 160,
					'url' => 'https://fbcdn-profile-a.akamaihd.net/hprofile-ak-ash3/c18.18.228.228/s160x160/1011813_4946765350273_384114079_n.jpg'
	 			));
			*/?>
			<div class="tc" style="padding-top:25px;">
				<h4>Մեսրոպ Մինասյան</h4>
				<h5>Marshrut.info-ի հիմնադիր</h5>
				<br>
				<a href="https://www.facebook.com/mesrop.minasyan" >
					<img src="<?/*= $img */?>" class="img-circle">
				</a>
			</div>
	 	</div> -->
	</div>

</div>