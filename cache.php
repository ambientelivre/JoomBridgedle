<?php
class JoomBridgedleCacheHelper
{
    public static function getCache($moduleId, $key)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->select($db->quoteName(['data', 'expiry_date']))
            ->from($db->quoteName('#__joombridgedle'))
            ->where($db->quoteName('module_id') . ' = ' . $db->quote($moduleId))
            ->where($db->quoteName('cache_key') . ' = ' . $db->quote($key));
        $db->setQuery($query);
        $result_db = $db->loadResult();

        if ($result_db) {
            $currentDate = JFactory::getDate()->toSql();
            // Verifica a validade do cache
            if ($result_db->expiry_date > $currentDate) {
                return json_decode($result_db->data, true);
            } else {
                // remove cache expirado
                self::clearCache($moduleId, $key);
            }
        }
        return false;
    }
    public static function setCache($moduleId, $key, $data, $expiryTime, $ModuleName)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true);
        $expiryDate = JFactory::getDate('+' . $expiryTime . ' minutes')->toSql();
        $existsQuery = $db->getQuery(true)
            ->select('COUNT(*)')
            ->from($db->quoteName('#__joombridgedle'))
            ->where($db->quoteName('module_id') . ' = ' . $db->quote($moduleId))
            ->where($db->quoteName('cache_key') . ' = ' . $db->quote($key));
        $db->setQuery($existsQuery);
        $exists = (int) $db->loadResult();

        if ($exists) {
            $query->update($db->quoteName('#__joombridgedle'))
                ->set($db->quoteName('data') . ' = ' . $db->quote(json_encode($data)))
                ->set($db->quoteName('cache_date') . ' = ' . $db->quote(JFactory::getDate()->toSql()))
                ->set($db->quoteName('expiry_date') . ' = ' . $db->quote($expiryDate))
                ->set($db->quoteName('module_name') . ' = ' . $db->quote($ModuleName))
                ->where($db->quoteName('module_id') . ' = ' . $db->quote($moduleId))
                ->where($db->quoteName('cache_key') . ' = ' . $db->quote($key));
        } else {
            $columns = array('module_id', 'cache_key', 'data', 'cache_date', 'expiry_date');
            $values = array($db->quote($moduleId), $db->quote($key), $db->quote(json_encode($data)), $db->quote(JFactory::getDate()->toSql()), $db->quote($expiryDate));

            $query->insert($db->quoteName('#__joombridgedle'))
                ->columns($db->quoteName($columns))
                ->values(implode(',', $values));
        }
        $db->setQuery($query);
        $db->execute();
    }
    public static function clearCache($moduleId, $key)
    {
        $db = JFactory::getDbo();
        $query = $db->getQuery(true)
            ->delete($db->quoteName('#__joombridgedle'))
            ->where($db->quoteName('module_id') . ' = ' . $db->quote($moduleId))
            ->where($db->quoteName('cache_key') . ' = ' . $db->quote($key));
        $db->setQuery($query);
        $db->execute();
    }
}
