<!-- faixa newsletter -->
<style>
.faixa-newsletter .wpcf7{
  width: 100%;
}
.faixa-newsletter span.wpcf7-form-control-wrap.your-email{
  display: flex;
  flex-grow: 1;
}
</style>
<div class="faixa-newsletter mt-5 mb-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-12 col-md-auto mt-3 mt-md-0 d-flex flex-grow-1">
              <?php echo do_shortcode('[contact-form-7 id="73" title="Newsletter"]'); ?>
                <!-- <form>
                    <p>Assine nossa newsletter</p>
                    <input name="faixa-newsletter-txt-email" type="email" placeholder="Qual é seu e-mail?" />
                    <button type="submit">ENVIAR</button>
                </form> -->
            </div>
        </div>
    </div>
</div>
