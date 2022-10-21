<?php

namespace App\Repositories;

use App\Entities\BannerCounterEntity;
use App\Exceptions\NotFoundException;
use PDO;

class BannerCounterRepository
{

    private $pdo;

    public function __construct()
    {
        $config = include __DIR__ . '/../../config/db.php';
        $dsn = "pgsql:host={$config['host']};port=5432;dbname={$config['db']};";
        $this->pdo = new PDO($dsn, $config['user'], $config['password']);
    }

    /**
     * @param string $ipAddress
     * @param string $userAgent
     * @param string $pageUrl
     * @return BannerCounterEntity
     * @throws NotFoundException
     */
    public function findOneUnique(string $ipAddress, string $userAgent, string $pageUrl): BannerCounterEntity
    {
        $sql = "
            SELECT * FROM \"banner_count\" 
            WHERE \"ip_address\" = :ip_address AND \"user_agent\" = :user_agent AND \"page_url\" = :page_url LIMIT 1";
        $sth = $this->pdo->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute([
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'page_url' => $pageUrl,
        ]);
        $row = $sth->fetch(PDO::FETCH_ASSOC);

        if ($row == null) {
            throw new NotFoundException();
        }

        $counterEntity = new BannerCounterEntity();
        $counterEntity->setId($row['id']);
        $counterEntity->setIpAddress($row['ip_address']);
        $counterEntity->setUserAgent($row['user_agent']);
        $counterEntity->setViewDate($row['view_date']);
        $counterEntity->setPageUrl($row['page_url']);
        $counterEntity->setViewsCount($row['views_count']);

        return $counterEntity;
    }

    public function insert(BannerCounterEntity $counterEntity): void
    {
        $sql = "
            INSERT INTO \"banner_count\" (\"ip_address\", \"user_agent\", \"view_date\", \"page_url\", \"views_count\")
            VALUES (:ip, :userAgent, now(), :pageUrl, :viewsCount)";
        $sth = $this->pdo->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute([
            'ip' => $counterEntity->getIpAddress(),
            'userAgent' => $counterEntity->getUserAgent(),
            'pageUrl' => $counterEntity->getPageUrl(),
            'viewsCount' => 1,
        ]);
    }

    public function update(BannerCounterEntity $counterEntity): void
    {
        $sql = "
            UPDATE \"banner_count\" 
            SET \"view_date\" = now(), \"views_count\" = :views_count 
            WHERE id = :id";
        $sth = $this->pdo->prepare($sql, [PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY]);
        $sth->execute([
            'id' => $counterEntity->getId(),
            'views_count' => $counterEntity->getViewsCount(),
        ]);
    }
}
