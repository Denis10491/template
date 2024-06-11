SUBJECT=$1
NAME=$2
NAME=$(echo "$NAME" | tr '[:lower:]' '[:upper:]' | head -c1)$(echo "$NAME" | tr '[:upper:]' '[:lower:]' | tail -c+2)

if [[ $SUBJECT -eq 'controller' ]]; then
echo '<?php

declare(strict_types=1);

namespace App\Controllers;

class '${NAME}'Controller
{
}
' > app/controllers/${NAME}Controller.php
fi

if [[ $SUBJECT -eq 'repository' ]]; then
echo '<?php

declare(strict_types=1);

namespace App\Repositories;

use Core\Repository\Repository;

class '${NAME}'Repository extends Repository
{
}
' > app/repositories/${NAME}Repository.php
fi