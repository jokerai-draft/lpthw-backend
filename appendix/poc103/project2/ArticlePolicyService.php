<?php
class ArticlePolicyService
{
    public function getPermission($currentUserId, $articleUserId) {
        return $currentUserId === $articleUserId;
    }
}
