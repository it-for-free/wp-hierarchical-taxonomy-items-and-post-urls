# wp-hierarchical-taxonomy-items-and-post-urls
[wordpress hierarchical taxonomy nested items and post urls]


## Установка

После установки (базывый способ - `composer`), 
возможно придется обновить маршруты просто сохраните настройки `Настройки -> Постоянные ссылки` (ничего там не меняя)

## Настройка

Предположим, что у вас есть тип записей `uslugi` и таксономия для них с названием `uslugicat`, тогда 
необходимо задать:

* слаг для *типа записи* `uslugi` как `uslugi/%uslugicat%`.
* слаг для *таксономии* `uslugicat` как `uslugi`  (необходимо, что было общий базовый url).
* **Важно:** В данный момент плагин работает успешно, тоьлко если работа  тип контента с тем же самым имененем,
    что и слага таксономии был зарегистрирован раньше, чем  эта таксономия  
    (например. может потребовать [правка в модуле CPT UI](http://fkn.ktu10.com/?q=node/10764), если вы используете его).


# Описание классов

Классы:

* `\ItForFree\WpHiUrls\HierarhicalUrls` Служит  создания иерархических url с общей базой для пользовательского 
типа контента и элементов таксономии. Его  функционал запускается модулем автоматически.
* `\ItForFree\WpHiUrls\Breadcrumbs` для хлебных крошек для этого формата. Этот код можно вручную использоваться в ваших шаблонах.



## Обновления

* `2019-04-17` добавлена поддержка записей, которые не относится ни к одной категории (маршрут и хлебные крошки как и для тех, что относятся)

## Прочее

* [Примеры работы с WordPress](http://fkn.ktu10.com/?q=node/10680)
