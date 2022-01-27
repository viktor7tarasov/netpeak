<?php

class FirstCest
{
    public function frontpageWorks(AcceptanceTester $I)
    {
      // 1. Перейти по ссылке на главную страницу сайта Netpeak. (https://netpeak.ua/).
      $I->amOnUrl('https://netpeak.ua/');
      // 2. Перейдите на страницу "Работа в Netpeak", нажав на кнопку "Карьера".
      $I->click('//*[@id="rec278727844"]/div/div/div/div[1]/div/nav/div[1]/div[1]/ul/li[4]/a'); // button "Карьера"
      $I->switchToNextTab();
      // 3. Перейти на страницу заполнения анкеты, нажав кнопку - "Я хочу работать в Netpeak".
      $I->click('/html/body/div[5]/div/div/div[2]/div/a'); // button "Я хочу работать в Netpeak"
      // 4. Загрузить файл с недопустимым форматом в блоке "Резюме", например png, и проверить что на странице появилось сообщение, о том что формат изображения неверный.
      $I->attachFile('//input[@type="file"]', 'cv.png');
      $I->wait(3); // 3 secs
      $I->seeInSource('<label class="control-label">Ошибка: неверный формат файла (разрешённые форматы: doc, docx, pdf, txt, odt, rtf).</label>');
      // 5. Заполнить случайными данными блок "3. Личные данные".
      $I->fillField('//*[@id="inputName"]', 'Qwerty'); // name
      $I->fillField('//*[@id="inputLastname"]', 'Ytrewq'); // last name
      $I->fillField('//*[@id="inputEmail"]', 'qwerty@email.com'); // email

      /*Year random*/
      $randomYear = rand(2, 53);
      $I->click('//*[@id="user-main-info"]/div[11]/div[2]/select/option['.$randomYear.']'); // select year from list
      /*End year random*/

      /*Month random*/
      $randomMonth = rand(2, 13);
      $I->click('//*[@id="user-main-info"]/div[11]/div[3]/select/option['.$randomMonth.']'); // select month from list
      /*End month random*/

      /*Day random*/
      $randomDay = rand(2, 29);
      $I->click('//*[@id="user-main-info"]/div[11]/div[4]/select/option['.$randomDay.']'); // select day from list
      /*End day random*/
      $I->wait(3); // 3 secs
      /*Phone random*/
      $phone = '';
      for ($d=0; $d<=rand(1, 20); $d++) $phone .= rand(0, 9);
      $I->fillField('//*[@id="inputPhone"]', $phone); // phone
      /*End phone random*/

      // 6. Нажать на кнопку отправить резюме.
      $I->click('//*[@id="submit"]'); // button "Отправить анкету"
      $I->wait(3); // 3 secs
      // 7. Проверить что сообщение на текущей странице - "Все поля являются обязательными для заполнения" - подсветилось красным цветом.
      $I->seeInSource('<div class="form-group has-error">
                      <p class="warning-fields help-block">Все поля являются обязательными для заполнения</p>
                      </div>');

      // 8. Перейти на страницу "Курсы" нажав соответствующую кнопку в меню и убедиться что открылась нужная страница.
      $I->click('//*[@id="main-menu"]/ul/li[3]/a'); // button "Интернатура"
      $I->seeInTitle('Образовательный Центр Netpeak: интернатура по SEO, PPC, PHP в Одессе');

      $I->wait(3); // 3 secs
    }
}

//php codecept.phar run tests/acceptance/FirstCest.php
